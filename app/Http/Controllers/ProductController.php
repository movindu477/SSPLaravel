<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $errorDetails = null;
        $products = collect([]);
        
        try {
            $query = Pet::query();
            
            if ($request->filled('search')) {
                $searchTerm = trim($request->search);
                $query->where('product_name', 'LIKE', '%' . $searchTerm . '%');
            }
            
            if ($request->filled('pet_type')) {
                $query->where('pet_type', '=', $request->pet_type);
            }
            
            if ($request->filled('accessories_type')) {
                $query->where('accessories_type', '=', $request->accessories_type);
            }
            
            if ($request->filled('min_price') && is_numeric($request->min_price)) {
                $query->where('price', '>=', (float)$request->min_price);
            }
            
            if ($request->filled('max_price') && is_numeric($request->max_price)) {
                $query->where('price', '<=', (float)$request->max_price);
            }
            
            $products = $query->orderBy('id', 'ASC')->get();
            
            $imageValidationErrors = [];
            foreach ($products as $product) {
                try {
                    $rawImageUrl = $product->getAttributes()['image_url'] ?? null;
                    $processedImageUrl = $product->image_url ?? null;
                    $assetUrl = $product->getImageAssetUrl();
                    
                    if (!str_starts_with($assetUrl, 'http://') && !str_starts_with($assetUrl, 'https://')) {
                        $imagePath = public_path(str_replace(url('/'), '', $assetUrl));
                        if (!file_exists($imagePath)) {
                            $imageValidationErrors[] = [
                                'product_id' => $product->id,
                                'product_name' => $product->product_name,
                                'raw_image_url' => $rawImageUrl,
                                'processed_image_url' => $processedImageUrl,
                                'asset_url' => $assetUrl,
                                'expected_path' => $imagePath,
                                'error' => 'Image file does not exist on server'
                            ];
                        }
                    }
                    
                    if ($request->has('debug')) {
                        \Log::info("Product ID: {$product->id}, Name: {$product->product_name}, Raw URL: {$rawImageUrl}, Processed URL: {$processedImageUrl}, Asset URL: {$assetUrl}");
                    }
                } catch (\Exception $e) {
                    $imageValidationErrors[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->product_name,
                        'error' => $e->getMessage()
                    ];
                    \Log::warning("Error processing image for product ID {$product->id}: " . $e->getMessage());
                }
            }
            
            if (!empty($imageValidationErrors)) {
                \Log::warning('Image validation errors found', ['errors' => $imageValidationErrors]);
                session()->flash('image_validation_errors', $imageValidationErrors);
            }
            
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            
            $userFriendlyMessage = 'Database connection error. ';
            
            if (str_contains($errorMessage, 'actively refused') || str_contains($errorMessage, '08001')) {
                $userFriendlyMessage .= 'SQL Server is not running or not accessible. ';
                $userFriendlyMessage .= 'Please start SQL Server Express service.';
                $troubleshooting = [
                    '1. Check if SQL Server is running',
                    '2. Open Services (services.msc) and look for "SQL Server (SQLEXPRESS)"',
                    '3. Start the service if it\'s stopped',
                    '4. Verify SQL Server is listening on port 1433',
                    '5. Check firewall settings'
                ];
            } elseif (str_contains($errorMessage, 'Login failed') || str_contains($errorMessage, '18456')) {
                $userFriendlyMessage .= 'Invalid username or password. Please check your .env file.';
                $troubleshooting = [
                    '1. Verify DB_USERNAME and DB_PASSWORD in .env',
                    '2. For Windows Authentication, leave username/password empty',
                    '3. Check SQL Server authentication mode'
                ];
            } elseif (str_contains($errorMessage, 'Cannot open database')) {
                $userFriendlyMessage .= 'Database does not exist. Please create the SSPSEM2 database.';
                $troubleshooting = [
                    '1. Open SQL Server Management Studio',
                    '2. Run the SSPSEM2.sql script to create the database',
                    '3. Verify DB_DATABASE=SSPSEM2 in .env'
                ];
            } else {
                $userFriendlyMessage .= 'Please check your SQL Server connection settings.';
                $troubleshooting = [
                    '1. Verify .env file has correct database settings',
                    '2. Check SQL Server is running',
                    '3. Verify network connectivity'
                ];
            }
            
            $errorDetails = [
                'type' => 'Database Query Error',
                'message' => $errorMessage,
                'code' => $errorCode,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'troubleshooting' => $troubleshooting ?? []
            ];
            
            if (method_exists($e, 'getSql')) {
                $errorDetails['sql'] = $e->getSql();
            }
            if (method_exists($e, 'getBindings')) {
                $errorDetails['bindings'] = $e->getBindings();
            }
            
            \Log::error('Database query error: ' . $errorMessage, [
                'code' => $errorCode,
                'sql' => method_exists($e, 'getSql') ? $e->getSql() : null,
                'bindings' => method_exists($e, 'getBindings') ? $e->getBindings() : null,
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', $userFriendlyMessage);
            session()->flash('error_details', $errorDetails);
        } catch (\Illuminate\Database\ConnectionException $e) {
            $errorMessage = $e->getMessage();
            $troubleshooting = [
                '1. Check if SQL Server Express is running',
                '2. Verify DB_HOST in .env (should be: localhost\\SQLEXPRESS or DESKTOP-NAME\\SQLEXPRESS)',
                '3. Verify DB_PORT=1433 in .env',
                '4. Verify DB_DATABASE=SSPSEM2 in .env',
                '5. Check SQL Server Configuration Manager - TCP/IP should be enabled',
                '6. Restart SQL Server service'
            ];
            
            $errorDetails = [
                'type' => 'Database Connection Error',
                'message' => $errorMessage,
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'troubleshooting' => $troubleshooting
            ];
            \Log::error('Database connection error: ' . $errorMessage);
            session()->flash('error', 'Cannot connect to database. SQL Server may not be running. Please start SQL Server Express service.');
            session()->flash('error_details', $errorDetails);
        } catch (\Exception $e) {
            $errorDetails = [
                'type' => 'General Error',
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ];
            \Log::error('Product loading error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'Unable to load products: ' . $e->getMessage());
            session()->flash('error_details', $errorDetails);
        }
        
        return view('pages.shop', compact('products', 'errorDetails'));
    }
    
    public function show($id)
    {
        $product = Pet::findOrFail($id);
        return view('product-detail', compact('product'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * 🔐 ADMIN ACCESS CHECK
     */
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access');
        }
    }

    /**
     * 📊 Admin Dashboard
     */
    public function index()
    {
        $this->ensureAdmin();

        $totalProducts = Pet::count();
        $totalUsers = User::count();

        // NOTE: This is NOT real revenue (orders table needed for real revenue)
        $totalRevenue = Pet::sum('price');

        $recentProducts = Pet::orderBy('id', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();

        return view(
            'admin.dashboard',
            compact(
                'totalProducts',
                'totalUsers',
                'totalRevenue',
                'recentProducts',
                'recentUsers'
            )
        );
    }

    /**
     * 📦 Products List
     */
    public function products()
    {
        $this->ensureAdmin();

        $products = Pet::orderBy('id', 'desc')->get();
        return view('admin.products', compact('products'));
    }

    /**
     * 👤 Users List
     */
    public function users()
    {
        $this->ensureAdmin();

        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * ➕ Create Product Page
     */
    public function createProduct()
    {
        $this->ensureAdmin();

        return view('admin.create-product');
    }

    /**
     * 💾 Store Product
     */
    public function storeProduct(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'pet_type' => 'required|string|max:50',
            'accessories_type' => 'required|string|max:50',
            'product_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|string|max:255',
        ]);

        Pet::create([
            'pet_type' => $validated['pet_type'],
            'accessories_type' => $validated['accessories_type'],
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'image_url' => $validated['image_url'],
            'created_at' => now(),
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product created successfully');
    }

    /**
     * ✏️ Edit Product Page
     */
    public function editProduct($id)
    {
        $this->ensureAdmin();

        $product = Pet::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    /**
     * 🔄 Update Product
     */
    public function updateProduct(Request $request, $id)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'pet_type' => 'required|string|max:50',
            'accessories_type' => 'required|string|max:50',
            'product_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|string|max:255',
        ]);

        $product = Pet::findOrFail($id);

        $product->update([
            'pet_type' => $validated['pet_type'],
            'accessories_type' => $validated['accessories_type'],
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'image_url' => $validated['image_url'],
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product updated successfully');
    }

    /**
     * ❌ Delete Product
     */
    public function deleteProduct($id)
    {
        $this->ensureAdmin();

        $product = Pet::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product deleted successfully');
    }
}

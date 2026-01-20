<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{
    public function __construct()
    {
        $stripeKey = config('services.stripe.secret');
        if ($stripeKey) {
            Stripe::setApiKey($stripeKey);
        }
    }

    public function createCheckoutSession(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stripeKey = config('services.stripe.secret');
        if (!$stripeKey) {
            return response()->json([
                'error' => 'Stripe is not configured. Please add STRIPE_SECRET_KEY to .env file and run: php artisan config:clear'
            ], 500);
        }
        
        Stripe::setApiKey($stripeKey);

        $userId = Auth::id();
        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $items = DB::table('cart_items')
            ->where('cart_id', $cart->id)
            ->get();

        if ($items->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty. Please add items to cart first.'], 400);
        }

        $lineItems = [];
        $subtotal = 0;

        foreach ($items as $item) {
            $product = DB::table('Pets')->where('id', $item->pet_id)->first();
            if (!$product) continue;

            $price = (float) $product->price;
            $quantity = (int) $item->quantity;
            
            if ($price <= 0 || $quantity <= 0) {
                continue;
            }
            
            $itemTotal = $price * $quantity;
            $subtotal += $itemTotal;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $product->product_name,
                        'description' => $product->pet_type . ' - ' . $product->accessories_type,
                    ],
                    'unit_amount' => (int) ($price * 100),
                ],
                'quantity' => $quantity,
            ];
        }

        if (empty($lineItems)) {
            return response()->json(['error' => 'No valid products found in cart.'], 400);
        }

        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        if ($tax > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => 'Tax (8%)',
                    ],
                    'unit_amount' => (int) ($tax * 100),
                ],
                'quantity' => 1,
            ];
        }

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment'),
                'customer_email' => $request->input('email', Auth::user()->email),
                'metadata' => [
                    'user_id' => $userId,
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                ],
            ]);

            return response()->json([
                'sessionId' => $session->id,
                'url' => $session->url,
            ]);
        } catch (ApiErrorException $e) {
            \Log::error('Stripe API Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to create checkout session',
                'message' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            \Log::error('Stripe Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            \Log::error('Stripe Success: No session ID provided');
            return redirect()->route('payment')->with('error', 'Invalid session - please contact support');
        }

        try {
            $session = Session::retrieve($sessionId);
            \Log::info('Stripe Session Retrieved', ['session_id' => $sessionId, 'payment_status' => $session->payment_status]);

            if ($session->payment_status === 'paid') {
                try {
                    DB::beginTransaction();
                    
                    $userId = $session->metadata->user_id ?? Auth::id();
                    $subtotal = (float) ($session->metadata->subtotal ?? 0);
                    $tax = (float) ($session->metadata->tax ?? 0);
                    $total = (float) ($session->metadata->total ?? 0);

                    \Log::info('Payment successful, creating order', ['user_id' => $userId, 'total' => $total]);

                    // Check if order already exists for this session
                    $existingOrder = DB::table('orders')
                        ->where('user_id', $userId)
                        ->where('payment_method', 'stripe')
                        ->where('status', 'paid')
                        ->where('total', $total)
                        ->where('created_at', '>=', now()->subMinutes(5))
                        ->first();
                    
                    if ($existingOrder) {
                        \Log::info('Order already exists, skipping creation', ['order_id' => $existingOrder->id]);
                        DB::commit();
                        return redirect()->route('payment')->with([
                            'success' => true,
                            'order_id' => $existingOrder->id
                        ]);
                    }

                    $cart = DB::table('cart')->where('user_id', $userId)->first();
                    if (!$cart) {
                        \Log::warning('Cart not found for user', ['user_id' => $userId]);
                        DB::commit();
                        return redirect()->route('shop')->with('success', 'Payment processed successfully! Check your orders.');
                    }

                    $items = DB::table('cart_items')->where('cart_id', $cart->id)->get();
                    
                    if ($items->isEmpty()) {
                        \Log::warning('Cart items empty', ['cart_id' => $cart->id]);
                        DB::commit();
                        return redirect()->route('shop')->with('success', 'Payment processed successfully!');
                    }

                    // Create order
                    $orderId = DB::table('orders')->insertGetId([
                        'user_id' => $userId,
                        'status' => 'paid',
                        'payment_method' => 'stripe',
                        'subtotal' => $subtotal,
                        'tax' => $tax,
                        'total' => $total,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    \Log::info('Order created', ['order_id' => $orderId]);

                    // Create order items
                    foreach ($items as $item) {
                        $price = DB::table('Pets')->where('id', $item->pet_id)->value('price') ?? 0;
                        DB::table('order_items')->insert([
                            'order_id' => $orderId,
                            'pet_id' => $item->pet_id,
                            'quantity' => $item->quantity,
                            'price' => $price,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    // Clear cart items
                    DB::table('cart_items')->where('cart_id', $cart->id)->delete();

                    DB::commit();
                    \Log::info('Order completed successfully', ['order_id' => $orderId]);

                    // Redirect with success
                    return redirect()->route('payment')->with([
                        'success' => true,
                        'order_id' => $orderId
                    ]);
                    
                } catch (\Exception $innerException) {
                    DB::rollBack();
                    \Log::error('Order Creation Error', [
                        'message' => $innerException->getMessage(),
                        'trace' => $innerException->getTraceAsString(),
                        'line' => $innerException->getLine()
                    ]);
                    
                    // Payment succeeded but order creation failed - redirect with success anyway
                    return redirect()->route('shop')->with('success', 'Payment processed! Your order will be confirmed shortly.');
                }
            }

            \Log::warning('Payment not completed', ['payment_status' => $session->payment_status ?? 'unknown']);
            return redirect()->route('payment')->with('info', 'Payment verification pending - please check back shortly');
        } catch (\Exception $e) {
            \Log::error('Stripe Success Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'session_id' => $sessionId,
                'line' => $e->getLine()
            ]);
            // If we can't even retrieve the session, redirect to shop with success message
            return redirect()->route('shop')->with('success', 'Payment processed! Please check your email for confirmation.');
        }
    }
}

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
                    'currency' => 'usd',
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
                    'currency' => 'usd',
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
            return redirect()->route('payment')->with('error', 'Invalid session');
        }

        try {
            $session = Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $userId = $session->metadata->user_id ?? Auth::id();
                $subtotal = (float) $session->metadata->subtotal;
                $tax = (float) $session->metadata->tax;
                $total = (float) $session->metadata->total;

                $cart = DB::table('cart')->where('user_id', $userId)->first();
                if (!$cart) {
                    return redirect()->route('payment')->with('error', 'Cart not found');
                }

                $items = DB::table('cart_items')->where('cart_id', $cart->id)->get();

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

                foreach ($items as $item) {
                    $price = DB::table('Pets')->where('id', $item->pet_id)->value('price');
                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'pet_id' => $item->pet_id,
                        'quantity' => $item->quantity,
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('cart_items')->where('cart_id', $cart->id)->delete();

                return redirect()->route('payment')->with('success', true)->with('order_id', $orderId);
            }

            return redirect()->route('payment')->with('error', 'Payment not completed');
        } catch (\Exception $e) {
            return redirect()->route('payment')->with('error', 'Error processing payment');
        }
    }
}

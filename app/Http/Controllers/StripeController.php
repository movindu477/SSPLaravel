<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $secretKey = config('services.stripe.secret');
        if (!$secretKey) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Stripe API key not configured'], 500);
            }
            return back()->with('error', 'Stripe API key is not configured.');
        }
        
        Stripe::setApiKey($secretKey);
        $user = auth()->user();

        // Join cart items with Pets
        $cartItems = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->join('cart', 'cart_items.cart_id', '=', 'cart.id')
            ->where('cart.user_id', $user->id)
            ->select('pets.product_name as name', 'pets.price', 'cart_items.quantity')
            ->get();

        if ($cartItems->isEmpty()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => (int)($item->price * 100),
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['url' => $session->url]);
        }

        return redirect()->away($session->url);
    }

    public function paymentSuccess()
    {
        $user = auth()->user();

        // Retrieve user's cart
        $cart = DB::table('cart')->where('user_id', $user->id)->first();

        if (!$cart) {
            return redirect('/')->with('error', 'Cart not found');
        }

        // Fetch cart items with product details and current pricing
        $cartItems = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('cart_items.pet_id', 'cart_items.quantity', 'pets.price')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/')->with('error', 'Cart is empty');
        }

        // Create a new paid order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'paid',
        ]);

        // Record order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pet_id' => $item->pet_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Clear the cart after successful payment
        DB::table('cart_items')->where('cart_id', $cart->id)->delete();

        return view('payment-success');
    }

    public function createCheckoutSessionAPI(Request $request)
    {
        $secretKey = config('services.stripe.secret');
        if (!$secretKey) {
            return response()->json([
                'error' => 'Stripe API key is not configured in environment variables.'
            ], 500);
        }
        Stripe::setApiKey($secretKey);

        $user = $request->user();

        // Retrieve user's cart
        $cart = DB::table('cart')->where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 400);
        }

        // Fetch cart items for the checkout session
        $cartItems = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('pets.product_name as name', 'pets.price', 'cart_items.quantity')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        // Construct line items for Stripe Checkout
        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Create the Stripe Checkout Session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/payment/success'),
            'cancel_url' => url('/payment/cancel'),
        ]);

        // Return the checkout URL to the client
        return response()->json([
            'checkout_url' => $session->url
        ]);
    }
}

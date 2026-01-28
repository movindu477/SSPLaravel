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
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();

        // Join cart items with Pets to get product details
        $cartItems = DB::table('cart_items')
            ->join('Pets', 'cart_items.pet_id', '=', 'Pets.id')
            ->where('cart_items.cart_id', function ($q) use ($user) {
                // Ensure we get the cart ID for the user
                $q->select('id')->from('cart')->where('user_id', $user->id);
            })
            ->select('Pets.product_name as name', 'Pets.price', 'cart_items.quantity') // Assuming product_name used in table
            ->get();


        $lineItems = [];

        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100, // Stripe expects amount in cents
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

        return response()->json([
            'url' => $session->url
        ]);
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
            ->join('Pets', 'cart_items.pet_id', '=', 'Pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('cart_items.pet_id', 'cart_items.quantity', 'Pets.price')
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
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = $request->user();

        // Retrieve user's cart
        $cart = DB::table('cart')->where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 400);
        }

        // Fetch cart items for the checkout session
        $cartItems = DB::table('cart_items')
            ->join('Pets', 'cart_items.pet_id', '=', 'Pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('Pets.product_name as name', 'Pets.price', 'cart_items.quantity')
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

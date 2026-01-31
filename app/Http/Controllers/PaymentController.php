<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Create a Stripe Payment Intent.
     * This is used for custom payment flows (e.g., Stripe Elements or Mobile Apps)
     * where you don't want to redirect to a Stripe-hosted checkout page.
     */
    public function createIntent(Request $request)
    {
        try {
            // 1. Set Stripe API Key from Config
            $secretKey = config('services.stripe.secret');
            if (!$secretKey) {
                return response()->json(['error' => 'Stripe API key not configured'], 500);
            }
            Stripe::setApiKey($secretKey);

            // 2. Validate basic input
            $request->validate([
                'amount' => 'required|numeric|min:1'
            ]);

            // 3. Convert LKR to cents (Stripe requirement)
            $amount = (int) ($request->amount * 100);

            // 4. Create the Payment Intent
            $intent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'lkr',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'user_id' => auth()->id() ?? 'guest',
                    'email' => auth()->user()->email ?? $request->email ?? 'unknown'
                ]
            ]);

            // 5. Return the Client Secret needed by the Frontend/Mobile App
            return response()->json([
                'client_secret' => $intent->client_secret,
                'id' => $intent->id
            ]);

        } catch (\Exception $e) {
            Log::error('Stripe PaymentIntent Error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

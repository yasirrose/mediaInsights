<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handleStripeWebhook(Request $request)
    {
        // Ensure the request comes from Stripe
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);

        } catch (SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                // Handle payment intent succeeded event
                $paymentIntent = $event->data->object;
                // Store $paymentIntent data in your database
                break;
                // Handle other event types as needed
            default:
                // Unknown event type
                return response()->json(['error' => 'Unknown event type'], 400);
        }

        // Return a response
        return response()->json(['message' => 'Event received'], 200);
    }
}

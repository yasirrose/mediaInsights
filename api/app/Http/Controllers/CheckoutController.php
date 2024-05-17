<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    // public function checkout(Request $request, $planId)
    // {
    //     // dd('vffdnvjkfnvj');
    //     try {
    //         $userId = $request->input('userId');
    //         // Set your Stripe API key
    //         Stripe::setApiKey('sk_test_51PArxqHlhw9UYvTNrPM1BY5cYRCjdZHJZWl8gbv4qcJxOhZCoXuCDfRx00PLv8ykXzGV3mCdTG32crUODoZS23yA00F9ypQpJ8');

    //         // Create a Checkout Session
    //         $session = Session::create([
    //             'payment_method_types' => ['card'],
    //             'line_items' => [[
    //                 'price' => $planId,
    //                 'quantity' => 1,
    //             ]],
    //             'mode' => 'subscription',
    //             'success_url' => 'http://localhost:5173/page/success', // Replace with your success URL
    //             'cancel_url' => 'http://localhost:5173/page/cancel', // Replace with your cancel URL
    //         ]);


    //         // Retrieve the user data based on the userId
    //         $user = User::find($userId);
    //         // Update the is_subscribed column value to 1
    //         $user->is_subscribed = 1;
    //         $user->save();
    //         // dd($user);
    //         return response()->json([
    //             'status' => 200,
    //             'checkoutUrl' => $session->url,
    //         ]);
    //     } catch (\Exception $e) {
    //         // Handle any errors
    //         return response()->json([
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    public function checkout(Request $request, $planId)
    {
        try {
            // Retrieve the user data based on the userId
            $userId = $request->input('userId');
            $user = User::find($userId);
            $product_Id = 'prod_Q0z5tI36emPeoL';

            if ($user) {
                $checkoutSession = $user
                    ->newSubscription($product_Id, $planId)
                    ->trialDays(1)
                    // ->allowPromotionCodes()
                    ->checkout([
                        'success_url' => 'http://localhost:5173/page/success',
                        'cancel_url' => 'http://localhost:5173/page/cancel',
                    ]);

                // if ($checkoutSession->status === 'approved') {
                //     // Update the is_subscribed column value to 1
                //     $user->is_subscribed = 1;
                //     $user->save();
                // } else {
                //     // Checkout failed
                // }
                // Update the is_subscribed column value to 1
                $user->is_subscribed = 1;
                $user->save();

                // Return the checkout URL in the JSON response
                return response()->json([
                    'status' => 200,
                    'checkoutUrl' => $checkoutSession->url,
                ]);
            } else {
                // Handle the scenario where the user with the provided ID is not found
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

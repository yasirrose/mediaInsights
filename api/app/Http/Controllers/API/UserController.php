<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Register a new user.
     */
    public function signupUser(Request $request)
    {

        $input = $request->all();
        // dd($input);
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'dob' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->messages()], 401);
        }

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->country = $input['country'];
        $user->gender = $input['gender'];
        // $user->dob = date('Y-m-d', strtotime(implode('-', $input['dob'])));
        $user->dob = $input['dob'];
        $user->gender = $input['gender'];
        $user->role_id = '2';
        $user->save();

        return response()->json([
            'data' => $user,
            'message' => 'User registered successfully.'
        ], 200);
    }
    /**
     * Display User data.
     */
    public function getUserDetails(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if a user is authenticated
        if ($user) {
            // User is authenticated, return user data
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        } else {
            // User is not authenticated
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated.',
            ], 401); // Unauthorized status code
        }
    }

    public function loginUser(Request $request)
    {
        $input = $request->all();

        // Retrieve the user based on the provided credentials
        $user = User::where('email', $input['email'])->first();

        if ($user) {
            // Check if the user meets the conditions for login
            $subscription = $user->subscription;
            if ($user->role_id == 1) {
                // Admin login
                if (Auth::attempt($input)) {
                    // User authentication successful
                    $authenticatedUser = Auth::user();
                    $token = $authenticatedUser->createToken('AccessToken')->accessToken;

                    return response()->json([
                        'status' => 'success',
                        'token'  => $token,
                        'authUser'  => $authenticatedUser,
                    ], 200);
                } else {
                    // Incorrect credentials for admin
                    return response()->json(['error' => 'Invalid credentials'], 401);
                }
            } else {
                // Non-admin login
                if ($subscription && $user->is_subscribed == 1 && $user->stripe_id != null && $subscription->trial_ends_at != now()) {
                    // Attempt to authenticate the user
                    if (Auth::attempt($input)) {
                        // User authentication successful
                        $authenticatedUser = Auth::user();
                        $token = $authenticatedUser->createToken('AccessToken')->accessToken;

                        return response()->json([
                            'status' => 'success',
                            'token'  => $token,
                            'authUser'  => $authenticatedUser,
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'You need to purchase a plan to access the dashboard.',
                            'redirect' => '/page/pricing', // Redirect URL for non-subscribed users
                            'user' => $user, // Pass user data
                        ], 403); // Forbidden status code
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You need to purchase a plan to access the dashboard.',
                        'redirect' => '/page/pricing', // Redirect URL for non-subscribed users
                        'user' => $user, // Pass user data
                    ], 403); // Forbidden status code
                }
            }
        } else {
            // User not found or invalid credentials
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    /**
     * Logout the specified user.
     */
    public function userLogout(Request $request)
    {
        // dd('aim here');
        if (Auth::guard('api')->check()) {
            $accessToken = Auth::guard('api')->user()->token();

            \DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => true]);
            $accessToken->revoke();

            return response(['data' => 'success', 'message' => 'User logout successfully.'], 200);
        }
        return response(['data' => 'Unauthorized'], 401);
    }
}

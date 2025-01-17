<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3|unique:users,name|regex:/^\S*$/',
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    public function referrals()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        return response()->json([
            'status' => true,
            'referrals' => $user->referrals,
            'referred_by' => $user->referredBy->name
        ], 200);
    }

    public function plans()
    {
        $plans = Plan::where('id', '!=', 1)->get();
        return response()->json([
            'status' => true,
            'plans' => $plans
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function addPurchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
            ], 400);
        }

        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $plan = Plan::find($request->plan_id);

        if (!$plan) {
            return response()->json([
                'status' => false,
                'message' => 'Plan not found',
            ], 404);
        }

        $additionalDuration = match ($plan->duration) {
            'weekly' => now()->addWeek(),
            'monthly' => now()->addMonth(),
            '6-month' => now()->addMonths(6),
            'yearly' => now()->addYear(),
            default => now()->addDays(7),
        };

        // Check if the user already has an active purchase
        $activePurchase = $user->purchases()
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();

        if ($activePurchase) {
            // Extend the current active purchase expiration date
            $activePurchase->update([
                'expires_at' => $activePurchase->expires_at->max(now())->add($additionalDuration->diff(now())),
            ]);

            $message = 'Purchase extended successfully!';
        } else {
            // Create a new purchase
            $activePurchase = $user->purchases()->create([
                'plan_id' => $plan->id,
                'started_at' => now(),
                'expires_at' => $additionalDuration,
                'is_active' => true,
            ]);

            $message = 'Purchase created successfully!';
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'purchase' => $activePurchase
        ], 201);
    }

    public function status()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $activePurchases = $user->purchases()
            ->where('is_active', true)
            ->orderBy('expires_at', 'desc')
            ->get();

        $inactivePurchases = $user->purchases()
            ->where('is_active', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'active_purchases' => $activePurchases,
            'inactive_purchases' => $inactivePurchases,
        ], 200);
    }
}

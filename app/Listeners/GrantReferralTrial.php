<?php

namespace App\Listeners;

use App\Models\ReferralSetting;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrantReferralTrial
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        /** @var \App\Models\User $user **/
        $user = $event->user;
        if ($user->referred_by) {
            /** @var \App\Models\User $referrer **/
            $referrer = $user->referredBy;

            if ($referrer) {
                // Get the referrer's active purchase, if any
                $activePurchase = $referrer->purchases()
                    ->where('is_active', true)
                    ->where('expires_at', '>', now())
                    ->first();

                if ($activePurchase) {
                    // Extend the expiration date by 1 day
                    $activePurchase->update([
                        'expires_at' => $activePurchase->expires_at->addDay(),
                    ]);
                } else {
                    // Create a new purchase with 1 day duration
                    $referrer->purchases()->create([
                        'plan_id' => '1', // Optional: Specify a trial plan ID if applicable
                        'started_at' => now(),
                        'expires_at' => now()->addDay(),
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    use HasFactory;

    protected $fillable = ['invite_count', 'trial_duration'];

    public static function getTrialTimeForReferrals($referralCount)
    {
        $setting = self::where('invite_count', '<=', $referralCount)
            ->orderBy('invite_count', 'desc')
            ->first();

        return $setting ? $setting->trial_duration : 1;
    }
}

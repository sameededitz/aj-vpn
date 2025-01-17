<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function showReferrals(User $user)
    {
        $referrals = $user->referrals()->with('referredUser')->get();
        return view('admin.all-refers', compact('user', 'referrals'));
    }
}

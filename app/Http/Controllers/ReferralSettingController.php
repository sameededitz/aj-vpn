<?php

namespace App\Http\Controllers;

use App\Models\ReferralSetting;
use Illuminate\Http\Request;

class ReferralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = ReferralSetting::all();
        return view('admin.referral-settings', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-referral');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invite_count' => 'required|integer|unique:referral_settings,invite_count',
            'trial_duration' => 'required|integer',
        ]);

        ReferralSetting::create([
            'invite_count' => $request->invite_count,
            'trial_duration' => $request->trial_duration,
        ]);

        return redirect()->route('referrals.index')->with([
            'status' => 'success',
            'message' => 'Referral Trial added successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferralSetting $referral)
    {
        return view('admin.edit-referral', compact('referral'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferralSetting $referral)
    {
        $request->validate([
            'invite_count' => 'required|integer|unique:referral_settings,invite_count,' . $referral->id,
            'trial_duration' => 'required|integer',
        ]);

        $referral->update($request->only('invite_count', 'trial_duration'));

        return redirect()->route('referrals.index')->with([
            'status' => 'success',
            'message' => 'Referral Trial updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReferralSetting $referral)
    {
        $referral->delete();
        return redirect()->route('referrals.index')->with([
            'status' => 'success',
            'message' => 'Referral Trial deleted successfully',
        ]);
    }
}

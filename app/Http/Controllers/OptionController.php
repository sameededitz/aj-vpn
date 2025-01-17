<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function Options()
    {
        // Fetch all options in a single query
        $options = Option::whereIn('key', [
            'privacy_policy',
            'tos',
        ])->get()->keyBy('key');

        $privacyPolicyContent = $options['privacy_policy']->value ?? '';
        $tosContent = $options['tos']->value ?? '';

        return view('admin.all-options', compact(
            'privacyPolicyContent',
            'tosContent'
        ));
    }

    public function saveOptions(Request $request)
    {
        $request->validate([
            'privacy_policy' => 'required',
            'tos' => 'required',
        ]);

        // Save the content to the database or file system
        Option::updateOrCreate(
            ['key' => 'privacy_policy'],
            ['value' => $request->input('privacy_policy')]
        );

        Option::updateOrCreate(
            ['key' => 'tos'],
            ['value' => $request->input('tos')]
        );

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Options saved successfully',
        ]);
    }

    public function getOptions()
    {
        // Fetch all options in a single query
        $options = Option::whereIn('key', [
            'privacy_policy',
            'tos',
        ])->get()->keyBy('key');

        $privacyPolicyContent = $options['privacy_policy']->value ?? '';
        $tosContent = $options['tos']->value ?? '';

        // Return the content as JSON
        return response()->json([
            'privacy_policy' => $privacyPolicyContent,
            'tos' => $tosContent,
        ]);
    }
}

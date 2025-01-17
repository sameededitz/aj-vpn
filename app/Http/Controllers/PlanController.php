<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Price;
use Stripe\StripeClient;

class PlanController extends Controller
{

    public function Plans()
    {
        $plans = Plan::where('id', '!=', 1)->get();
        return view('admin.all-plans', compact('plans'));
    }

    public function AddPlan()
    {
        return view('admin.add-plan');
    }

    public function EditPlan(Plan $plan)
    {
        return view('admin.edit-plan', compact('plan'));
    }

    public function deletePlan(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('all-plans')->with([
            'status' => 'success',
            'message' => 'Plan Deleted Successfully.',
        ]);
    }
}

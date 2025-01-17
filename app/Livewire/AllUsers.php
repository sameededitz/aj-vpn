<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\Purchase;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AllUsers extends Component
{
    public $users;
    public $selectedUser;
    public $plans;
    #[Validate]
    public $plan_id;

    protected  function rules()
    {
        return [
            'plan_id' => 'required|exists:plans,id',
        ];
    }

    public function mount()
    {
        $this->users = User::where('role', '!=', 'admin')
            ->with(['purchases' => function ($query) {
                $query->latest()->first();
            }])
            ->get();

        $this->plans = Plan::where('id', '!=', 1)->get();
    }

    public function addPurchase()
    {
        $this->validate();

        $plan = Plan::find($this->plan_id);

        $additionalDuration = match ($plan->duration) {
            'weekly' => now()->addWeek(),
            'monthly' => now()->addMonth(),
            '6-month' => now()->addMonths(6),
            'yearly' => now()->addYear(),
            default => now()->addDays(7),
        };

        $activePurchase = $this->selectedUser->purchases()
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();

        if ($activePurchase) {
            // Extend the current active purchase expiration date
            $activePurchase->update([
                'expires_at' => $activePurchase->expires_at->max(now())->add($additionalDuration->diff(now())),
            ]);
        } else {
            // Create a new purchase
            $this->selectedUser->purchases()->create([
                'plan_id' => $plan->id,
                'started_at' => now(),
                'expires_at' => $additionalDuration,
                'is_active' => true,
            ]);
        }

        $this->selectedUser = null;
        $this->plan_id = '';

        // Reload users to update the table
        $this->mount();

        $this->dispatch('close-modal');
        $this->dispatch('alert_add', ['type' => 'success', 'message' => 'Purchase added successfully!']);
    }

    public function openModal(User $user)
    {
        $this->selectedUser = $user;
        $this->plan_id = '';
        $this->dispatch('open-modal');
    }

    public function clearPurchase(User $user)
    {
        $user->purchases()->delete();
        // Reload users to update the table
        $this->mount();

        $this->dispatch('alert_clear', ['type' => 'success', 'message' => 'Purchase cleared successfully!']);
    }

    public function render()
    {
        return view('livewire.all-users');
    }
}

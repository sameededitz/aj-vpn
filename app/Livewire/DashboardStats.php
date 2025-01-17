<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\Server;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public $userCount;
    public $planCount;
    public $totalServers;

    public function mount()
    {
        $this->userCount = User::count();
        $this->planCount = Plan::where('id', '!=', 1)->count();
        $this->totalServers = Server::count();
    }
    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}

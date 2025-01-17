<?php

use App\Console\Commands\ExpireSubscriptions;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('auth:clear-resets')->everyFifteenMinutes()->onOneServer()->withoutOverlapping();

Schedule::command('purchases:remove-expired')->daily()->onOneServer()->withoutOverlapping();

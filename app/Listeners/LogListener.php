<?php

namespace App\Listeners;

use App\Events\UserLog;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
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
    public function handle(UserLog $event): void
    {
        Log::create([
            'user_id'   =>auth()->user()->id,
            'log_entry' => $event->log_entry
        ]);
    }
}

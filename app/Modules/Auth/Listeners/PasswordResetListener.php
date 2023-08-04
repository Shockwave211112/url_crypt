<?php

namespace App\Modules\Auth\Listeners;

use App\Modules\Auth\Events\PasswordResetting;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetListener implements ShouldQueue
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
    public function handle(PasswordResetting $event): void
    {
        //
    }
}

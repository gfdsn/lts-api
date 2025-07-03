<?php

namespace App\Application\User\Listeners;

use App\Domain\User\Events\UserRegistered;
use App\Domain\User\Jobs\SendWelcomeEmailJob;

class SendWelcomeEmail
{
    public function handle(UserRegistered $event)
    {
        SendWelcomeEmailJob::dispatch($event->user);
    }
}

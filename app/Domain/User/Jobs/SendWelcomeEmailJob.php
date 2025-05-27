<?php

namespace App\Domain\User\Jobs;

use App\Domain\User\Entities\User;
use App\Infrastructure\Persistence\User\Models\UserModel;
use App\Mail\IndividualWelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public UserModel $user
    ){}

    public function handle(): void
    {
        \Log::info($this->user->email);
        Mail::to($this->user->email)->send(new IndividualWelcomeEmail($this->user));
    }

}

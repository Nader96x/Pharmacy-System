<?php

namespace App\Jobs;

use App\Notifications\InactiveUserForMonthNotification;
use App\Notifications\UserGreetingNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $user;
    protected $notificationType;
    public function __construct($user, $notificationType)
    {
        $this->user = $user;
        $this->notificationType = $notificationType;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $notification = null;
        switch ($this->notificationType) {
            case 'inactive_user_for_month_notification':
                $notification = new InactiveUserForMonthNotification($this->user);
                break;
            case 'user_greeting_notification':
                $notification = new UserGreetingNotification($this->user);
        }
        $this->user->notify($notification);
    }
}

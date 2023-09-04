<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailNotificationsJob;
use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Subscription;
use App\Notifications\NewPostNotification;
use Exception;
use Illuminate\Support\Facades\Notification;

class SendEmailNotifications extends Command
{
    protected $signature = 'email:send-notifications';
    protected $description = 'Send email to subscribers for new posts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try{
            dispatch(new SendEmailNotificationsJob());
            $this->info('Email notifications scheduled for sending in the background.');
        }catch (Exception $e){
            $this->info('error' . $e);
        }
    }
}

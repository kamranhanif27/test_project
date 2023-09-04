<?php

namespace App\Jobs;

use App\Mail\NewPostMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $newPosts = Post::where('created_at', '>', now()->subHours(24))->get();

        foreach ($newPosts as $post) {
            $subscribers = Subscription::where('website_id', $post->website_id)->get();

            foreach ($subscribers as $subscriber) {
                // Check if the email for this post and subscriber hasn't been sent yet
                if (!$post->emailHasBeenSentToSubscriber($subscriber->user_email)) {
                    // Send email notification
                    Mail::to($subscriber->user_email)->send(new NewPostMail($post));

                    // Mark the email as sent
                    $post->markEmailAsSentToSubscriber($subscriber->user_email);
                }
            }
        }
    }
}

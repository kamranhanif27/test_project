<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'title',
        'description'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function emailHasBeenSentToSubscriber($subscriberEmail)
    {
        return $this->emailLog()->where('subscriber_email', $subscriberEmail)->exists();
    }

    public function markEmailAsSentToSubscriber($subscriberEmail)
    {
        // Create a record in a separate table to log email sending
        EmailLog::create([
            'post_id' => $this->id,
            'subscriber_email' => $subscriberEmail,
        ]);
    }

    public function emailLog()
    {
        return $this->hasMany(EmailLog::class);
    }
}

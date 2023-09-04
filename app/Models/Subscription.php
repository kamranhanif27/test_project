<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_email', 'website_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(SubscribeRequest $request)
    {
        $existingSubscription = Subscription::where('user_email', $request->user_email)
            ->where('website_id', $request->website_id)
            ->first();

        if ($existingSubscription) {
            return response()->json(['message' => 'User is already subscribed to this website.'], 400);
        }

        Subscription::create([
            'user_email' => $request->user_email,
            'website_id' => $request->website_id,
        ]);

        return response()->json(['message' => 'Subscription created successfully.'], 201);
    }
}

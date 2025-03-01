<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'plan' => 'required|string|in:basic,premium'
        ]);


        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan' => $request->plan
        ]);

        return response()->json($subscription, 201);
    }
}

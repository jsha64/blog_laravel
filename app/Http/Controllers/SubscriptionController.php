<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'plan' => 'required|string'
        ]);

        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan' => $request->plan
        ]);

        return response()->json([
            'message' => 'Suscripción creada exitosamente',
            'subscription' => $subscription
        ], 201);
    }
}


<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseSuccessMail;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
        ]);

        $user = Auth::user();
        $tool = Tool::findOrFail($request->tool_id);

        if ($user->balance < $tool->price) {
            return back()->with('error', 'Insufficient balance. Please fund your wallet.');
        }

        // Deduct balance
        $user->decrement('balance', $tool->price);

        // Record purchase
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'tool_id' => $tool->id,
            'price' => $tool->price,
            'status' => 'completed',
        ]);

        // Category specific logic
        if ($tool->category === 'Websites') {
            try {
                Mail::to($user->email)->send(new PurchaseSuccessMail($user, $tool));
            } catch (\Exception $e) {
                logger('Failed to send purchase success email: ' . $e->getMessage());
            }
            return back()->with('success', "Success! You have purchased {$tool->name}. An email has been sent to you.");
        } else {
            // For documents/ID cards, redirect to the edit/generate page
            // We will build this view in the next step
            return redirect()->route('dashboard')->with('success', "Success! Please provide the details for your {$tool->name} in your dashboard.");
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function build(Tool $tool)
    {
        // For websites, we don't have a 'build' flow before purchase
        if ($tool->category === 'Websites') {
            return redirect()->route('home')->with('error', 'Websites must be purchased directly.');
        }

        return view('user.tools.build', compact('tool'));
    }

    public function generate(Request $request, Tool $tool)
    {
        $user = Auth::user();

        // Validate details (simplified for now)
        $request->validate([
            'surname' => 'required',
            'given_name' => 'required',
        ]);

        if ($user->balance < $tool->price) {
            return back()->with('error', 'Insufficient balance. Please fund your wallet to generate this document.');
        }

        // Deduct balance
        $user->decrement('balance', $tool->price);

        // Record purchase
        Purchase::create([
            'user_id' => $user->id,
            'tool_id' => $tool->id,
            'price' => $tool->price,
            'status' => 'completed',
        ]);

        // Logic to generate document would go here
        
        return back()->with('success', "Success! Your {$tool->name} has been generated. Balance deducted: $" . number_format($tool->price, 2));
    }
}

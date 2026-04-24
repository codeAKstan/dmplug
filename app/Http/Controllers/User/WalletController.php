<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function generate(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->wallet_address) {
            $user->update([
                'wallet_address' => 'DM-' . strtoupper(Str::random(12))
            ]);
        }

        return back()->with('success', 'Wallet generated successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        
        // Since we don't have revenue/tools tables yet, we'll use placeholder real-looking logic
        // In a real app, these would come from Transaction and Tool models
        $totalRevenue = 0; // Or calculate from a payments table if it existed
        $availableTools = 4; // Based on the landing page categories
        
        return view('admin.dashboard', compact('totalUsers', 'totalRevenue', 'availableTools'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function toggleBlock(User $user)
    {
        $user->update(['is_blocked' => !$user->is_blocked]);
        $status = $user->is_blocked ? 'blocked' : 'unblocked';
        return back()->with('success', "User $status successfully.");
    }

    public function updateBalance(Request $request, User $user)
    {
        $request->validate(['balance' => 'required|numeric|min:0']);
        $user->update(['balance' => $request->balance]);
        return back()->with('success', 'User balance updated successfully.');
    }

    public function fundAccount(Request $request, User $user)
    {
        $request->validate(['amount' => 'required|numeric|min:0']);
        $user->increment('balance', $request->amount);
        return back()->with('success', 'User account funded successfully.');
    }

    public function createTool()
    {
        return "Add tool page coming soon.";
    }
}

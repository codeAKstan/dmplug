<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        
        // Since we don't have revenue/tools tables yet, we'll use placeholder real-looking logic
        // In a real app, these would come from Transaction and Tool models
        $totalRevenue = 0; 
        $availableTools = Tool::count();
        
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
        return view('admin.dashboard'); // Just redirect to dashboard where the modal is
    }

    public function storeTool(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'sub_category' => 'nullable|string',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validated['category'] !== 'Websites') {
            $validated['sub_category'] = null;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tools', 'public');
            $validated['image'] = $path;
        }

        Tool::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Tool added successfully!');
    }
}

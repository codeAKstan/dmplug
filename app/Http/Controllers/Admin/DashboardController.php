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
        return "Users management page coming soon.";
    }

    public function createTool()
    {
        return "Add tool page coming soon.";
    }
}

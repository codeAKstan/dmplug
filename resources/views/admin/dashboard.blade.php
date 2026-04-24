<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | DMPlug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen">
    <nav class="border-b border-white/5 px-6 py-4 flex justify-between items-center backdrop-blur-md sticky top-0 z-50">
        <h1 class="text-2xl font-bold tracking-tight">Admin <span class="text-[#EFFF00]">Dashboard</span></h1>
        <div class="flex items-center gap-6">
            <span class="text-white/50 text-sm">Welcome, {{ Auth::guard('admin')->user()->name }}</span>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white/50 hover:text-white transition-colors text-sm font-medium">Logout</button>
            </form>
        </div>
    </nav>

    <main class="p-10 container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Total Users</h3>
                <p class="text-4xl font-bold">{{ number_format($totalUsers) }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Total Revenue</h3>
                <p class="text-4xl font-bold text-[#EFFF00]">${{ number_format($totalRevenue, 2) }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Available Tools</h3>
                <p class="text-4xl font-bold">{{ number_format($availableTools) }}</p>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-xl font-bold mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('admin.users.index') }}" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                    <div class="mb-4 text-[#EFFF00] group-hover:text-black transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold group-hover:text-black transition-colors">View Users</h4>
                    <p class="text-white/40 text-sm mt-1 group-hover:text-black/60 transition-colors">Manage registered accounts</p>
                </a>

                <a href="{{ route('admin.tools.create') }}" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                    <div class="mb-4 text-[#EFFF00] group-hover:text-black transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold group-hover:text-black transition-colors">Add Tools</h4>
                    <p class="text-white/40 text-sm mt-1 group-hover:text-black/60 transition-colors">List a new product or tool</p>
                </a>
            </div>
        </div>
    </main>
</body>
</html>

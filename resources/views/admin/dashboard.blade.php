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
                <p class="text-4xl font-bold">1,284</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Total Revenue</h3>
                <p class="text-4xl font-bold text-[#EFFF00]">$4,820</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Pending Tools</h3>
                <p class="text-4xl font-bold">12</p>
            </div>
        </div>

        <div class="mt-10 bg-white/5 border border-white/10 rounded-[40px] p-10 h-96 flex items-center justify-center">
            <p class="text-white/20 text-xl font-medium">Dashboard charts and detailed stats will appear here.</p>
        </div>
    </main>
</body>
</html>

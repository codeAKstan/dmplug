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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen" x-data="{ addToolModal: false }">
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

                <button @click="addToolModal = true" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                    <div class="mb-4 text-[#EFFF00] group-hover:text-black transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold group-hover:text-black transition-colors">Add Tools</h4>
                    <p class="text-white/40 text-sm mt-1 group-hover:text-black/60 transition-colors">List a new product or tool</p>
                </button>
            </div>
        </div>
    </main>

    <!-- Add Tool Modal -->
    <div x-show="addToolModal" 
         x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" @click="addToolModal = false"></div>
        
        <div class="relative w-full max-w-4xl bg-[#0A0A0A] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="p-10">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Choose <span class="text-[#EFFF00]">Category</span></h2>
                        <p class="text-white/50">Select the type of tool you want to add to the platform.</p>
                    </div>
                    <button @click="addToolModal = false" class="p-3 bg-white/5 rounded-full hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Website Category -->
                    <a href="#" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                        <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold group-hover:text-black transition-colors">Websites</h4>
                        <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Domain names and full sites</p>
                    </a>

                    <!-- Receipts Category -->
                    <a href="#" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                        <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold group-hover:text-black transition-colors">Receipts</h4>
                        <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Payment and purchase proof</p>
                    </a>

                    <!-- ID Cards Category -->
                    <a href="#" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                        <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold group-hover:text-black transition-colors">ID Cards</h4>
                        <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Identity and license templates</p>
                    </a>

                    <!-- Tickets Category -->
                    <a href="#" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                        <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold group-hover:text-black transition-colors">Tickets</h4>
                        <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Event and travel tickets</p>
                    </a>

                    <!-- Holding Paper Category -->
                    <a href="#" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                        <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold group-hover:text-black transition-colors">Holding Paper</h4>
                        <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Selfie with document images</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

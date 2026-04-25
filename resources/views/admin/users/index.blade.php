<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | DMPlug Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        table { border-spacing: 0; }
        thead tr:first-child th:first-child { border-top-left-radius: 40px; }
        thead tr:first-child th:last-child { border-top-right-radius: 40px; }
        tbody tr:last-child td:first-child { border-bottom-left-radius: 40px; }
        tbody tr:last-child td:last-child { border-bottom-right-radius: 40px; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen" x-data="{ activeUser: null, actionModal: null }">
    <nav class="border-b border-white/5 px-6 py-4 flex justify-between items-center backdrop-blur-md sticky top-0 z-40 bg-[#0a0a0a]/80">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-white/50 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold tracking-tight">Manage <span class="text-[#EFFF00]">Users</span></h1>
        </div>
        <div class="flex items-center gap-6">
            <span class="text-white/50 text-sm">Welcome, {{ Auth::guard('admin')->user()->name }}</span>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white/50 hover:text-white transition-colors text-sm font-medium">Logout</button>
            </form>
        </div>
    </nav>

    <main class="p-10 container mx-auto">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-[40px] shadow-2xl">
            <div class="">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-wider text-white/40">User</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-wider text-white/40">Email</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-wider text-white/40">Wallet Address</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-wider text-white/40">Balance</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-wider text-white/40">Status</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-wider text-white/40 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($users as $user)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-full bg-[#EFFF00] flex items-center justify-center text-black font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-white group-hover:text-[#EFFF00] transition-colors">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-white/60">{{ $user->email }}</td>
                                <td class="px-8 py-6">
                                    @if($user->wallet_address)
                                        <code class="text-xs bg-white/5 px-2 py-1 rounded border border-white/10 text-white/40">{{ $user->wallet_address }}</code>
                                    @else
                                        <span class="text-white/20 italic text-xs">Not set</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 font-mono text-[#EFFF00]">${{ number_format($user->balance, 2) }}</td>
                                <td class="px-8 py-6">
                                    @if($user->is_blocked)
                                        <span class="px-3 py-1 bg-red-500/10 text-red-400 text-xs font-bold rounded-full border border-red-500/20">Blocked</span>
                                    @else
                                        <span class="px-3 py-1 bg-green-500/10 text-green-400 text-xs font-bold rounded-full border border-green-500/20">Active</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right" x-data="{ dropdownOpen: false }" :class="dropdownOpen ? 'z-50 relative' : ''">
                                    <div class="flex justify-end gap-3 relative">
                                        <!-- Edit Button with Dropdown -->
                                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" 
                                                class="p-2 bg-white/5 border border-white/10 rounded-xl hover:bg-[#EFFF00] transition-all text-white/60 hover:text-black" title="Quick Actions">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>

                                        <!-- Action Dropdown -->
                                        <div x-show="dropdownOpen" x-cloak 
                                             class="absolute right-0 top-full mt-2 w-48 bg-[#141414] border border-white/10 rounded-2xl shadow-2xl z-50 py-2 overflow-hidden">
                                            
                                            <!-- Block Action -->
                                            <form action="{{ route('admin.users.toggle-block', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full text-left px-4 py-3 text-sm hover:bg-white/5 transition-colors flex items-center gap-3 {{ $user->is_blocked ? 'text-green-400' : 'text-red-400' }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                                </button>
                                            </form>

                                            <!-- Fund Action -->
                                            <button @click="activeUser = {{ json_encode($user) }}; actionModal = 'fund'; dropdownOpen = false" 
                                                    class="w-full text-left px-4 py-3 text-sm text-white/70 hover:bg-white/5 transition-colors flex items-center gap-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                Fund Account
                                            </button>

                                            <!-- Edit Balance Action -->
                                            <button @click="activeUser = {{ json_encode($user) }}; actionModal = 'balance'; dropdownOpen = false" 
                                                    class="w-full text-left px-4 py-3 text-sm text-white/70 hover:bg-white/5 transition-colors flex items-center gap-3 border-b border-white/5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Edit Balance
                                            </button>

                                            <!-- Delete Action -->
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-white/40 hover:bg-red-500/10 hover:text-red-400 transition-colors flex items-center gap-3">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Delete User
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center text-white/20 font-medium">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($users->hasPages())
                <div class="px-8 py-6 border-t border-white/5 bg-white/[0.01]">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </main>

    <!-- Modals -->
    <template x-if="actionModal === 'fund'">
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-6">
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="actionModal = null"></div>
            <div class="relative w-full max-w-md bg-[#141414] border border-white/10 rounded-[30px] shadow-2xl overflow-hidden">
                <form :action="'{{ url('admin/users') }}/' + activeUser.id + '/fund'" method="POST">
                    @csrf
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-2">Fund Account</h2>
                        <p class="text-white/50 text-sm mb-6">Adding funds to <span class="text-white font-bold" x-text="activeUser.name"></span>'s account.</p>
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2">Amount to Add ($)</label>
                            <input type="number" step="0.01" name="amount" required autofocus
                                   class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-[#EFFF00] transition-colors font-mono text-lg" 
                                   placeholder="0.00">
                        </div>
                    </div>
                    <div class="bg-white/5 p-8 flex gap-3">
                        <button type="button" @click="actionModal = null" class="flex-1 py-4 bg-white/5 hover:bg-white/10 text-white font-bold rounded-2xl transition-all">Cancel</button>
                        <button type="submit" class="flex-1 py-4 bg-[#EFFF00] hover:bg-white text-black font-bold rounded-2xl transition-all shadow-lg shadow-[#EFFF00]/10">Add Funds</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <template x-if="actionModal === 'balance'">
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-6">
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="actionModal = null"></div>
            <div class="relative w-full max-w-md bg-[#141414] border border-white/10 rounded-[30px] shadow-2xl overflow-hidden">
                <form :action="'{{ url('admin/users') }}/' + activeUser.id + '/update-balance'" method="POST">
                    @csrf
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-2">Edit Balance</h2>
                        <p class="text-white/50 text-sm mb-6">Setting a new balance for <span class="text-white font-bold" x-text="activeUser.name"></span>.</p>
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2">New Balance ($)</label>
                            <input type="number" step="0.01" name="balance" :value="activeUser.balance" required autofocus
                                   class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-[#EFFF00] transition-colors font-mono text-lg" 
                                   placeholder="0.00">
                        </div>
                    </div>
                    <div class="bg-white/5 p-8 flex gap-3">
                        <button type="button" @click="actionModal = null" class="flex-1 py-4 bg-white/5 hover:bg-white/10 text-white font-bold rounded-2xl transition-all">Cancel</button>
                        <button type="submit" class="flex-1 py-4 bg-[#EFFF00] hover:bg-white text-black font-bold rounded-2xl transition-all shadow-lg shadow-[#EFFF00]/10">Set Balance</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</body>
</html>

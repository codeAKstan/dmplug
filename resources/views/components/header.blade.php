<div x-data="{ mobileMenuOpen: false, userDropdownOpen: false, toolsModalOpen: false, walletModalOpen: false, fundModalOpen: false, fundAmount: 7 }">
    <nav class="sticky top-0 z-[40] bg-[#0A0A0A]/90 backdrop-blur-md">
    <div class="flex items-center justify-between px-6 md:px-16 py-5">
    @php
        $allTools = \App\Models\Tool::latest()->get();
        $whatsappNumber = \App\Models\Setting::where('key', 'whatsapp_number')->first()?->value ?? '+2348052923367';
    @endphp
    <!-- Logo Section -->
    <div class="flex items-center">
        <a href="/" class="flex items-center group transition-transform duration-300 hover:scale-[1.02]">
            <img src="{{ asset('images/dmplug-logo.png') }}" alt="DMPlug Logo" class="h-24 w-auto rounded-md shadow-lg shadow-black/20">
        </a>
    </div>

    <!-- Desktop Navigation & CTA -->
    <div class="flex items-center space-x-8 md:space-x-12">
        <!-- Navigation Links -->
        <div class="hidden lg:flex items-center space-x-10">
                @auth
                    <button @click="walletModalOpen = true" class="text-[15px] text-white/70 font-medium hover:text-white transition-colors duration-200">My Wallet</button>
                @else
                    <a href="{{ route('login') }}" class="text-[15px] text-white/70 font-medium hover:text-white transition-colors duration-200">My Wallet</a>
                @endauth
            <button @click="toolsModalOpen = true" class="text-[15px] text-white/70 font-medium hover:text-white transition-colors duration-200">All Tools</button>
        </div>

        <div class="flex items-center space-x-6">

            <!-- Auth Section -->
            <div class="flex items-center pl-6 ml-2">
                @auth
                    <div class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" class="flex items-center space-x-3 focus:outline-none group">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="h-9 w-9 rounded-full object-cover border-2 border-transparent group-hover:border-[#EFFF00] transition-all" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                <div class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center text-white text-sm font-bold group-hover:bg-[#EFFF00] group-hover:text-black transition-all">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="hidden md:block text-[15px] text-white/70 font-medium group-hover:text-white transition-colors">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white/40 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- User Dropdown -->
                        <div x-show="userDropdownOpen" 
                             x-cloak
                             @click.away="userDropdownOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 transform"
                             x-transition:enter-end="opacity-100 scale-100 transform"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100 transform"
                             x-transition:leave-end="opacity-0 scale-95 transform"
                             class="absolute right-0 mt-3 w-56 bg-[#141414] border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] py-2.5 overflow-hidden ring-1 ring-white/5">
                            <div class="px-4 py-3 border-b border-white/5 mb-1">
                                <p class="text-[12px] text-white/40 font-medium uppercase tracking-wider">Signed in as</p>
                                <p class="text-[14px] text-white font-bold truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 px-4 py-2.5 text-[14px] text-white/70 hover:bg-white/5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span>Profile Settings</span>
                            </a>
                            <div class="border-t border-white/5 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" @click.prevent="$root.submit();" class="flex items-center space-x-3 w-full text-left px-4 py-2.5 text-[14px] text-red-400 hover:bg-red-400/10 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 bg-[#EFFF00] text-[#0A0A0A] text-[14px] font-bold rounded-full hover:bg-white hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-[#EFFF00]/10">Sign In</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="lg:hidden relative z-[70] text-white/70 hover:text-white focus:outline-none p-2 -mr-2 transition-colors duration-200">
                <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    </nav>

    <!-- Mobile Menu Backdrop -->
    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false"
         class="fixed inset-0 bg-black/80 backdrop-blur-md z-[60] lg:hidden">
    </div>

    <!-- Mobile Menu Drawer -->
    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition transform ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition transform ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 w-[85%] max-w-[400px] h-full bg-[#0A0A0A] z-[65] lg:hidden shadow-2xl border-l border-white/5"
         x-init="$watch('mobileMenuOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })">
        
        <div class="flex flex-col h-full p-8 pt-24">
            <div class="flex flex-col space-y-8">
                @auth
                    <button @click="walletModalOpen = true; mobileMenuOpen = false" class="text-[24px] text-left text-white/70 font-semibold hover:text-[#EFFF00] transition-colors">My Wallet</button>
                @else
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="text-[24px] text-white/70 font-semibold hover:text-[#EFFF00] transition-colors">My Wallet</a>
                @endauth
                <button @click="toolsModalOpen = true; mobileMenuOpen = false" class="text-[24px] text-left text-white/70 font-semibold hover:text-[#EFFF00] transition-colors">All Tools</button>
                
                <div class="h-px bg-white/5 my-4"></div>
                
                @auth
                    <div class="flex items-center space-x-4 mb-6">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="h-12 w-12 rounded-full object-cover border-2 border-[#EFFF00]" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                            <div class="h-12 w-12 rounded-full bg-[#EFFF00] flex items-center justify-center text-black text-lg font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <span class="text-white font-bold">{{ Auth::user()->name }}</span>
                            <span class="text-white/40 text-sm italic">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.show') }}" @click="mobileMenuOpen = false" class="text-[18px] text-white/70 font-medium hover:text-white">Profile Settings</a>
                    
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" @click.prevent="$root.submit(); mobileMenuOpen = false" class="text-[18px] text-red-400 font-medium hover:text-red-300">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="flex items-center justify-center py-5 bg-[#EFFF00] text-black text-[18px] font-bold rounded-2xl hover:bg-white transition-all shadow-lg shadow-[#EFFF00]/10">Sign In</a>
                @endauth
            </div>

            <div class="mt-auto pt-10 text-center">
                <p class="text-white/20 text-sm font-medium">&copy; {{ date('Y') }} DMPlug</p>
            </div>
        </div>
    </div>
    <!-- All Tools Modal -->
    <div x-show="toolsModalOpen" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-start justify-center p-4 md:p-12 overflow-y-auto"
         x-init="$watch('toolsModalOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })">
        <div x-show="toolsModalOpen" 
             x-transition:enter="transition opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/90 backdrop-blur-xl" 
             @click="toolsModalOpen = false"></div>

        <div x-show="toolsModalOpen" 
             x-transition:enter="transition transform ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition transform ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-10"
             class="relative w-full max-w-7xl my-auto bg-[#0F0F0F] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden flex flex-col max-h-[calc(100vh-100px)]">
            
            <div class="p-8 md:p-12 flex justify-between items-center border-b border-white/5">
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold mb-3">All <span class="text-[#EFFF00]">Tools</span></h2>
                    <p class="text-white/40 text-lg font-medium">Browse our full collection of premium digital assets.</p>
                </div>
                <button @click="toolsModalOpen = false" class="group p-5 bg-white/5 rounded-3xl hover:bg-red-500/20 border border-white/5 transition-all duration-300">
                    <svg class="w-8 h-8 text-white/50 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex-grow overflow-y-auto p-8 md:p-12 custom-scrollbar">
                @if($allTools->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">No tools listed yet</h3>
                        <p class="text-white/40">Check back later for new arrivals.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($allTools as $tool)
                            <div class="group bg-white/5 border border-white/10 rounded-3xl p-6 hover:bg-white/10 transition-all duration-300">
                                <div class="flex items-center space-x-6">
                                    <div class="w-24 h-24 rounded-2xl overflow-hidden flex-shrink-0">
                                        @if($tool->image)
                                            <img src="{{ asset('storage/' . $tool->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-[#EFFF00]/10 flex items-center justify-center text-[#EFFF00]">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#EFFF00] bg-[#EFFF00]/10 px-2 py-0.5 rounded">{{ $tool->sub_category ?? $tool->category }}</span>
                                            <span class="text-sm font-bold text-[#EFFF00]">${{ number_format($tool->price, 2) }}</span>
                                        </div>
                                        <h4 class="text-lg font-bold mt-2 text-white group-hover:text-[#EFFF00] transition-colors">{{ $tool->name }}</h4>
                                        <p class="text-white/40 text-[13px] mt-1 line-clamp-1">{{ $tool->description ?? 'Premium quality asset.' }}</p>
                                    </div>
                                </div>
                                <a href="#" class="mt-6 w-full py-3 bg-white/5 border border-white/10 rounded-xl text-[13px] font-bold text-white hover:bg-[#EFFF00] hover:text-black hover:border-[#EFFF00] transition-all flex items-center justify-center gap-2">
                                    View Details
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- My Wallet Modal -->
    @auth
    <div x-show="walletModalOpen" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-10"
         x-init="$watch('walletModalOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })">
        <div x-show="walletModalOpen" 
             x-transition:enter="transition opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/90 backdrop-blur-xl" 
             @click="walletModalOpen = false"></div>

        <div x-show="walletModalOpen" 
             x-transition:enter="transition transform ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition transform ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-10"
             class="relative w-full max-w-2xl bg-[#0F0F0F] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden flex flex-col">
            
            <div class="p-8 md:p-10 flex justify-between items-center border-b border-white/5">
                <div>
                    <h2 class="text-3xl font-bold mb-1">My <span class="text-[#EFFF00]">Wallet</span></h2>
                    <p class="text-white/40 font-medium">Manage your funds and assets.</p>
                </div>
                <button @click="walletModalOpen = false" class="p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-8 md:p-10">
                @if(!Auth::user()->wallet_address)
                    <!-- Generate Account State -->
                    <div class="text-center py-10">
                        <div class="w-24 h-24 bg-[#EFFF00]/10 rounded-full flex items-center justify-center mx-auto mb-8">
                            <svg class="w-12 h-12 text-[#EFFF00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">No Active Wallet</h3>
                        <p class="text-white/40 mb-10 max-w-md mx-auto leading-relaxed">Secure your account by generating a unique wallet address. This will allow you to fund your account and purchase tools instantly.</p>
                        
                        <form action="{{ route('wallet.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-5 bg-[#EFFF00] text-black font-extrabold text-lg rounded-2xl hover:bg-white hover:scale-[1.02] transition-all shadow-xl shadow-[#EFFF00]/20">
                                Generate Wallet Account
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Wallet Dashboard State -->
                    <div class="space-y-8">
                        <!-- Balance Card -->
                        <div class="bg-gradient-to-br from-[#1A1A1A] to-[#111111] border border-white/10 rounded-[32px] p-8 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#EFFF00]/5 rounded-full -mr-10 -mt-10 blur-3xl group-hover:bg-[#EFFF00]/10 transition-all"></div>
                            
                            <div class="relative z-10">
                                <div class="flex justify-between items-start mb-6">
                                    <span class="text-white/40 font-bold uppercase tracking-widest text-xs">Total Balance</span>
                                    <div class="px-3 py-1 bg-[#EFFF00]/10 rounded-full">
                                        <span class="text-[#EFFF00] text-[10px] font-bold tracking-tighter italic">ACTIVE WALLET</span>
                                    </div>
                                </div>
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-5xl font-black text-white">${{ number_format(Auth::user()->balance, 2) }}</span>
                                    <span class="text-white/20 font-bold text-xl uppercase tracking-tighter">USD</span>
                                </div>
                            </div>
                        </div>

                        <!-- Wallet Address -->
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-white/40 text-xs font-bold uppercase tracking-widest">Wallet Address</span>
                                <button class="text-[#EFFF00] text-xs font-bold hover:underline" @click="navigator.clipboard.writeText('{{ Auth::user()->wallet_address }}'); alert('Address copied!')">Copy Address</button>
                            </div>
                            <div class="text-white font-mono text-lg break-all bg-black/20 p-3 rounded-xl border border-white/5">
                                {{ Auth::user()->wallet_address }}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <button @click="fundModalOpen = true; walletModalOpen = false" class="py-5 bg-white text-black font-bold rounded-2xl hover:bg-[#EFFF00] transition-all flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Fund Wallet
                            </button>
                            <button class="py-5 bg-white/5 border border-white/10 text-white font-bold rounded-2xl hover:bg-white/10 transition-all flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                                Withdraw
                            </button>
                        </div>

                        <p class="text-center text-white/20 text-xs font-medium">All transactions are secured with end-to-end encryption.</p>
                    </div>
                @endif
            </div>
        </div>
        </div>
    @endauth
    <!-- Fund Wallet Modal -->
    @auth
    <div x-show="fundModalOpen" 
         x-cloak
         class="fixed inset-0 z-[110] flex items-center justify-center p-4 md:p-10"
         x-init="$watch('fundModalOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })">
        <div x-show="fundModalOpen" 
             x-transition:enter="transition opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/90 backdrop-blur-xl" 
             @click="fundModalOpen = false"></div>

        <div x-show="fundModalOpen" 
             x-transition:enter="transition transform ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition transform ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-10"
             class="relative w-full max-w-lg bg-[#0F0F0F] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden flex flex-col">
            
            <div class="p-8 flex justify-between items-center border-b border-white/5">
                <div>
                    <h2 class="text-2xl font-bold mb-1">Fund <span class="text-[#EFFF00]">Account</span></h2>
                    <p class="text-white/40 text-sm font-medium">Enter amount to deposit.</p>
                </div>
                <button @click="fundModalOpen = false; walletModalOpen = true" class="p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
            </div>

            <div class="p-8">
                <div class="bg-white/5 border border-white/10 rounded-3xl p-8 mb-8 text-center">
                    <span class="text-white/40 text-xs font-bold uppercase tracking-[0.2em] mb-4 block">Deposit Amount</span>
                    <div class="flex items-center justify-center space-x-6">
                        <button @click="if(fundAmount > 7) fundAmount--" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-[#EFFF00] hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path></svg>
                        </button>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-white/20 text-2xl font-bold">$</span>
                            <span class="text-6xl font-black text-white" x-text="fundAmount"></span>
                        </div>
                        <button @click="fundAmount++" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-[#EFFF00] hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                    <p class="text-white/20 text-xs mt-6 font-medium">Minimum deposit: <span class="text-white">$7.00</span></p>
                </div>

                <div class="bg-red-500/10 border border-red-500/20 rounded-2xl p-6 mb-8">
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-red-500 text-sm font-bold leading-relaxed">
                            To avoid losing your deposits, only trade with the following softbaker approved vendors on whatsapp when paying with Naira.
                        </p>
                    </div>
                    <div class="mt-4 pl-10">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" target="_blank" class="inline-flex items-center space-x-2 text-white font-mono text-lg hover:text-[#EFFF00] transition-colors">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span>{{ $whatsappNumber }}</span>
                        </a>
                    </div>
                </div>

                <a :href="'https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text=Hello, I want to fund my wallet with $' + fundAmount + '. My wallet address is: {{ Auth::user()->wallet_address }}'" target="_blank" class="w-full py-5 bg-[#EFFF00] text-black font-extrabold text-lg rounded-2xl hover:bg-white transition-all shadow-xl shadow-[#EFFF00]/20 flex items-center justify-center gap-3">
                    Proceed to WhatsApp
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
    @endauth
</div>




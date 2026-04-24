<nav x-data="{ mobileMenuOpen: false, userDropdownOpen: false }" class="sticky top-0 z-50 flex items-center justify-between px-6 md:px-16 py-5 bg-[#0A0A0A]/90 backdrop-blur-md">
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
            <a href="#" class="text-[15px] text-white/70 font-medium hover:text-white transition-colors duration-200">My Wallet</a>
            <a href="#" class="text-[15px] text-white/70 font-medium hover:text-white transition-colors duration-200">All Tools</a>
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
                <a href="#" @click="mobileMenuOpen = false" class="text-[24px] text-white/70 font-semibold hover:text-[#EFFF00] transition-colors">My Wallet</a>
                <a href="#" @click="mobileMenuOpen = false" class="text-[24px] text-white/70 font-semibold hover:text-[#EFFF00] transition-colors">All Tools</a>
                
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
</nav>




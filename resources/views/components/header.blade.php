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
                        </button>

                        <!-- User Dropdown -->
                        <div x-show="userDropdownOpen" @click.away="userDropdownOpen = false" 
                             class="absolute right-0 mt-3 w-48 bg-[#141414] border border-white/10 rounded-xl shadow-2xl py-2 overflow-hidden">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2.5 text-[14px] text-white/70 hover:bg-white/5 hover:text-white transition-colors">Profile Settings</a>
                            <div class="border-t border-white/5 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" @click.prevent="$root.submit();" class="w-full text-left px-4 py-2.5 text-[14px] text-red-400 hover:bg-red-400/10 transition-colors">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 bg-[#EFFF00] text-[#0A0A0A] text-[14px] font-bold rounded-full hover:bg-white hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-[#EFFF00]/10">Sign In</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-white/70 hover:text-white focus:outline-none">
                <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="absolute top-full left-0 w-full bg-[#0F0F0F] py-8 px-8 lg:hidden shadow-2xl">
        <div class="flex flex-col space-y-6">
            <a href="#" class="text-[18px] text-white/70 font-medium hover:text-white transition-colors">My Wallet</a>
            <a href="#" class="text-[18px] text-white/70 font-medium hover:text-white transition-colors">All Tools</a>
            @auth
                <a href="{{ route('profile.show') }}" class="text-[16px] text-white/70 font-medium">Profile Settings</a>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" @click.prevent="$root.submit();" class="text-[16px] text-red-400 font-medium">
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="flex items-center justify-center py-4 bg-[#EFFF00] text-black text-[16px] font-bold rounded-full transition-all">Sign In</a>
            @endauth
        </div>
    </div>
</nav>




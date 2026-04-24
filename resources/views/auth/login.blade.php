<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-white/50 text-[14px]">Sign in to access your account</p>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email Address') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Enter your email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between mb-2">
                    <x-label for="password" value="{{ __('Password') }}" class="mb-0" />
                    @if (Route::has('password.request'))
                        <a class="text-[13px] text-[#EFFF00] hover:text-white transition-colors" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="••••••••" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center group cursor-pointer">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-white/50 group-hover:text-white transition-colors">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div>
                <x-button>
                    {{ __('Sign In') }}
                </x-button>
            </div>

            <div class="text-center pt-4">
                <p class="text-white/50 text-[14px]">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-[#EFFF00] font-semibold hover:underline">Sign up for free</a>
                </p>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

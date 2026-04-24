<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-2">Create Account</h2>
            <p class="text-white/50 text-[14px]">Join DMPlug and start your journey</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Full Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email Address') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="john@example.com" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <label for="terms" class="flex items-center group cursor-pointer">
                        <x-checkbox name="terms" id="terms" required />
                        <div class="ms-2 text-sm text-white/50 group-hover:text-white transition-colors">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-[#EFFF00] hover:underline">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-[#EFFF00] hover:underline">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </label>
                </div>
            @endif

            <div class="pt-2">
                <x-button>
                    {{ __('Create Account') }}
                </x-button>
            </div>

            <div class="text-center pt-4">
                <p class="text-white/50 text-[14px]">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-[#EFFF00] font-semibold hover:underline">Sign in instead</a>
                </p>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

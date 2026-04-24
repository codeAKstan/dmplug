@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-8']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="px-6 py-8 bg-[#141414] border border-white/5 shadow-xl {{ isset($actions) ? 'rounded-t-2xl' : 'rounded-2xl' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-6 py-4 bg-[#1A1A1A] border-x border-b border-white/5 text-end rounded-b-2xl shadow-xl">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>

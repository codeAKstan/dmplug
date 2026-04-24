@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-[14px] text-white/70 mb-2']) }}>
    {{ $value ?? $slot }}
</label>

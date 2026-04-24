@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-400 mt-2 font-medium']) }}>{{ $message }}</p>
@enderror

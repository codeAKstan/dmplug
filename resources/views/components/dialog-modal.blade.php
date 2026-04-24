@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-6">
        <div class="text-xl font-bold text-white">
            {{ $title }}
        </div>

        <div class="mt-4 text-[15px] text-white/70 leading-relaxed">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-[#1A1A1A] border-t border-white/5 text-end">
        {{ $footer }}
    </div>
</x-modal>

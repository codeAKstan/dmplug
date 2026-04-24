<div class="min-h-[calc(100vh-100px)] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0A0A0A]">
    <div class="mb-8">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md px-8 py-10 bg-[#141414] border border-white/5 shadow-[0_0_50px_-12px_rgba(239,255,0,0.05)] overflow-hidden sm:rounded-2xl">
        {{ $slot }}
    </div>
</div>

<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-2.5 bg-white/5 border border-white/10 rounded-xl font-bold text-[14px] text-white hover:bg-white/10 hover:border-white/20 transition-all active:scale-[0.98] disabled:opacity-25']) }}>
    {{ $slot }}
</button>

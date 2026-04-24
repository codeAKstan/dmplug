<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-red-500/10 border border-red-500/20 rounded-xl font-bold text-[14px] text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all active:scale-[0.98] disabled:opacity-25']) }}>
    {{ $slot }}
</button>

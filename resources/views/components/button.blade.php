<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-4 bg-[#EFFF00] hover:bg-white text-black font-bold text-[15px] rounded-xl transition-all duration-300 shadow-lg shadow-[#EFFF00]/10 hover:shadow-white/10 active:scale-[0.98]']) }}>
    {{ $slot }}
</button>

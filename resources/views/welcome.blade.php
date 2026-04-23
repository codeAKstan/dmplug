<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .tool-card { @apply relative overflow-hidden rounded-[40px] transition-all duration-500 hover:scale-[1.01]; }
            .arrow-icon { @apply w-12 h-12 rounded-full bg-black/10 flex items-center justify-center backdrop-blur-sm transition-transform duration-300 hover:scale-110; }
        </style>
    </head>
    <body class="bg-[#0a0a0a] text-white flex flex-col min-h-screen">
        <x-header />

        <main class="flex-grow pt-20 pb-40 px-6 md:px-16 container mx-auto">
            <!-- Headline Section -->
            <div class="mb-16">
                <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-6">
                    No subscriptions,<br> <span class="text-[#FCC900]">No. 1 </span> place for generating websites and documents.
                </h1>
                <p class="text-xl md:text-2xl text-white/50 max-w-2xl font-medium">
                    The best AI tools to generate any website and edit documents without any coding or editing skill.
                </p>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 min-h-[700px]">
                
                <!-- Main Large Card (Yellow) -->
                <div class="lg:col-span-2 tool-card bg-[#FCC900] text-black p-10 flex flex-col justify-between">
                    <div>
                        <h2 class="text-5xl font-bold mb-2">Websites</h2>
                        <p class="text-xl font-medium opacity-80 mb-8">Banking and Investment websites.</p>
                        <div class="mb-10">
                            <span class="text-sm font-bold uppercase tracking-wider opacity-60">Start from</span>
                            <div class="text-4xl font-bold mt-1">$59.99</div>
                        </div>
                    </div>
                    
                    <div class="relative mt-auto">
                        <img src="{{ asset('images/bank.jpg') }}" alt="Compresto UI" class="rounded-2xl shadow-2xl transform translate-y-20 hover:translate-y-10 transition-transform duration-700 w-full object-cover">
                        <button class="absolute left-0 bottom-32 px-8 py-3 bg-black/10 backdrop-blur-md rounded-full text-black font-bold hover:bg-black/20 transition-all">
                            View details
                        </button>
                    </div>
                </div>

                <!-- Middle Column Stack -->
                <div class="lg:col-span-1 flex flex-col gap-6">
                    <!-- Green Card -->
                    <div class="tool-card bg-[#2BB69C] p-8 flex flex-col h-1/2">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-3xl font-bold mb-1">Tickets</h3>
                                <p class="text-sm font-medium opacity-80">Flight tickets with tracking website.</p>
                            </div>
                        </div>
                        <div class="mt-auto flex justify-between items-end">
                            <div>
                                <span class="text-[12px] font-bold uppercase tracking-wider opacity-60">Start from</span>
                                <div class="text-3xl font-bold mt-1">$9.99</div>
                            </div>
                            <div class="arrow-icon">
                                <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pink Card -->
                    <div class="tool-card bg-[#F482FF] p-8 flex flex-col h-1/2">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-3xl font-bold mb-1">Shipping</h3>
                                <p class="text-sm font-medium opacity-80">Shipping/Consignment With Tracking Website</p>
                            </div>
                        </div>
                        <div class="mt-auto flex justify-between items-end">
                            <div>
                                <span class="text-[12px] font-bold uppercase tracking-wider opacity-60">Start from</span>
                                <div class="text-3xl font-bold mt-1">$19.99</div>
                            </div>
                            <div class="arrow-icon">
                                <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tall Card (Tan) -->
                <div class="lg:col-span-1 tool-card bg-[#EBE3D5] text-black flex flex-col">
                    <div class="p-8">
                        <h3 class="text-3xl font-bold mb-1">ID Card</h3>
                        <p class="text-sm font-medium opacity-80 mb-6">ID Card (3+ Types)</p>
                        <div class="mb-8">
                            <span class="text-sm font-bold uppercase tracking-wider opacity-60">Start from</span>
                            <div class="text-3xl font-bold mt-1">$9.99</div>
                        </div>
                    </div>
                    
                    <div class="relative flex-grow overflow-hidden px-4">
                        <img src="{{ asset('images/passport.jpg') }}" alt="Eagle UI" class="rounded-t-2xl shadow-xl w-full h-full object-cover object-top">
                        <div class="absolute bottom-6 left-6 arrow-icon bg-black/5 hover:bg-black/10">
                            <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="py-10 border-t border-white/5 text-center text-white/20 text-sm font-medium">
            &copy; {{ date('Y') }} DMPlug. All rights reserved.
        </footer>
    </body>
</html>

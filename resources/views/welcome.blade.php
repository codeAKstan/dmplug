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
        @livewireStyles
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
            <!-- Tools -->
            <div class="mt-32 bg-[#ffffff] text-black p-16 text-center overflow-hidden relative rounded-[60px]" >
                <h2 class="text-6xl font-bold mb-4">Available <span class="text-[#2BB69C]">Tools</span></h2>
                <p class="text-xl mb-12 font-medium">A list of premium tools and websites available for instant access.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
                @foreach($tools as $tool)
                <div class="group bg-white/5 border border-white/10 rounded-[40px] overflow-hidden hover:border-[#EFFF00]/50 transition-all duration-500 flex flex-col">
                    <div class="aspect-video overflow-hidden relative">
                        @if($tool->image)
                        <img src="{{ asset('storage/' . $tool->image) }}" alt="{{ $tool->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="w-full h-full bg-[#EFFF00]/10 flex items-center justify-center text-[#EFFF00]">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#EFFF00] bg-black/50 backdrop-blur-md px-3 py-1 rounded-full border border-white/10">{{ $tool->sub_category ?? $tool->category }}</span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold line-clamp-1">{{ $tool->name }}</h3>
                            <div class="text-xl font-bold text-[#EFFF00]">${{ number_format($tool->price, 2) }}</div>
                        </div>
                        
                        <p class="text-white/40 text-sm line-clamp-2 mb-8 flex-grow">{{ $tool->description ?? 'Premium quality tool for your professional needs.' }}</p>
                        
                        <a href="#" class="w-full py-4 rounded-2xl bg-white/5 border border-white/10 text-white font-bold flex items-center justify-center gap-2 hover:bg-[#EFFF00] hover:text-black hover:border-[#EFFF00] transition-all duration-300 group/btn">
                            Purchase Tool
                            <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
                
            <!-- CTA -->
                <div class="mt-32 bg-[#FCE26F] text-black rounded-[60px] p-16 text-center overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-[#FCE26F] via-[#FFC433] to-[#FFB661] opacity-20 pointer-events-none"></div>
                    
                    <h2 class="text-6xl font-bold mb-4">Ready to turn your ideas into reality?</h2>
                    <p class="text-xl mb-12 font-medium">Get instant access to premium templates and designs.</p>
                    
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <a href="#" class="px-8 py-5 rounded-full bg-black text-white font-bold hover:bg-gray-800 transition-all shadow-2xl transform hover:-translate-y-1 hover:scale-[1.02]">Browse Templates</a>
                        <a href="#" class="px-8 py-5 rounded-full bg-white text-black font-bold hover:bg-gray-100 transition-all shadow-lg transform hover:-translate-y-1 hover:scale-[1.02]">Contact Us</a>
                    </div>
                </div>
            <!-- Disclaimer -->
            <div class="mt-32 bg-[#2BB69C] text-white rounded-[60px] p-16 text-center overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-[#2BB69C] via-[#2BB69C] to-[#2BB69C] opacity-20 pointer-events-none"></div>
                
                <h2 class="text-6xl font-bold mb-4">Disclaimer!!!</h2>
                <p class="text-xl mb-12 font-medium">By using this website, you agree that this website is just a piece of software to create documents, websites, and tools for the sole purpose of content creation, and that you're 100% responsible for whatever you do with the tools available on this webites, the documents or links generated for you on this website.

You agree by using this website that the owner(s) of this website and other websites it is connected to, such as the documents viewing website(s) and websites are not responsible in any way for whatever you do with them..</p>
            </div>
            
        </main>

        <footer class="py-10 border-t border-white/5 text-center text-white/20 text-sm font-medium">
            &copy; {{ date('Y') }} DMPlug. All rights reserved.
        </footer>
        @livewireScripts
    </body>
</html>

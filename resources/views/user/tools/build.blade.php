<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize {{ $tool->name }} | DMPlug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .input-field { 
            width: 100%;
            background-color: #ffffff !important;
            color: #000000 !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            outline: none;
            border-color: #EFFF00;
        }
        .input-field::placeholder {
            color: rgba(0, 0, 0, 0.4) !important;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen">
    <x-header />

    <main class="container mx-auto px-6 md:px-16 py-20">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ url('/') }}" class="p-3 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h1 class="text-4xl font-bold tracking-tight">Customize <span class="text-[#EFFF00]">{{ $tool->name }}</span></h1>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="mb-10 bg-[#EFFF00]/10 border border-[#EFFF00]/20 text-[#EFFF00] px-8 py-4 rounded-3xl flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-10 bg-red-500/10 border border-red-500/20 text-red-500 px-8 py-4 rounded-3xl flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Left: Instructions & Preview -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white/5 border border-white/10 rounded-[32px] p-8">
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-black/40 border border-white/5 flex items-center justify-center text-white/10 mb-6">
                            @if($tool->image)
                                <img src="{{ asset('storage/' . $tool->image) }}" class="w-full h-full object-cover opacity-50">
                            @else
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold mb-2">How it works</h3>
                        <p class="text-white/40 text-sm leading-relaxed">
                            Fill in all the required fields on the right. Once you're happy with the details, click "Generate". 
                            <br><br>
                            <span class="text-[#EFFF00] font-bold">Important:</span> Clicking "Generate" will debit <span class="font-bold text-white">${{ number_format($tool->price, 2) }}</span> from your wallet balance.
                        </p>
                    </div>

                    <div class="bg-[#EFFF00] text-black rounded-[32px] p-8">
                        <span class="text-[10px] font-bold uppercase tracking-widest block mb-2 opacity-60">Your Balance</span>
                        <div class="text-4xl font-black">${{ number_format(Auth::user()->balance, 2) }}</div>
                        <a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold border-b-2 border-black/10 hover:border-black transition-all pb-1">
                            Fund Wallet
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white/5 border border-white/10 rounded-[40px] p-10">
                        <form action="{{ route('tools.generate', $tool->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                            @csrf
                            
                            <div class="flex bg-white/5 p-1 rounded-2xl border border-white/10 mb-10">
                                <button type="button" class="flex-1 py-3 bg-[#EFFF00] text-black font-bold rounded-xl">Edit Mode</button>
                                <button type="button" disabled class="flex-1 py-3 text-white/20 font-bold cursor-not-allowed">View Mode</button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        Surname
                                        <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    </label>
                                    <input type="text" name="surname" placeholder="e.g. Herwell" class="input-field" required>
                                </div>

                                <div class="space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        Given Name
                                        <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    </label>
                                    <input type="text" name="given_name" placeholder="e.g. Marie R" class="input-field" required>
                                </div>

                                <div class="space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        Date Of Birth
                                    </label>
                                    <input type="text" name="dob" placeholder="e.g. 1989MAY12" class="input-field">
                                </div>

                                <div class="space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        SSN Number
                                    </label>
                                    <input type="text" name="ssn" placeholder="e.g. 056-42-7523" class="input-field">
                                </div>

                                <div class="space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        Pay Grade
                                    </label>
                                    <input type="text" name="pay_grade" placeholder="e.g. E5" class="input-field">
                                </div>

                                <div class="space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        Rank
                                    </label>
                                    <input type="text" name="rank" placeholder="e.g. SGT" class="input-field">
                                </div>

                                <div class="col-span-full space-y-3">
                                    <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                        Profile Picture
                                    </label>
                                    <div class="relative group cursor-pointer" onclick="document.getElementById('doc_pic').click()">
                                        <div class="w-full bg-white/5 border-2 border-dashed border-white/10 rounded-2xl py-10 flex flex-col items-center justify-center hover:bg-white/10 hover:border-[#EFFF00]/50 transition-all">
                                            <svg class="w-12 h-12 text-white/20 mb-4 group-hover:text-[#EFFF00] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-white/40 font-bold">Click to upload photo</p>
                                        </div>
                                        <input type="file" id="doc_pic" name="picture" class="hidden">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-10 flex flex-col gap-4">
                                <button type="submit" class="w-full py-6 bg-[#EFFF00] text-black font-extrabold text-xl rounded-[24px] hover:scale-[1.02] transition-all shadow-2xl shadow-[#EFFF00]/20 flex items-center justify-center gap-3">
                                    Generate & Debit Wallet
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </button>
                                <p class="text-center text-white/20 text-xs font-medium">By clicking Generate, you agree to debit ${{ number_format($tool->price, 2) }} from your balance.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-20 border-t border-white/5 text-center text-white/20 text-sm font-medium">
        &copy; {{ date('Y') }} DMPlug. All rights reserved.
    </footer>
</body>
</html>

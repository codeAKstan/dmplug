@php
    $user = Auth::user();
    $purchases = \App\Models\Purchase::where('user_id', $user->id)->with('tool')->latest()->get();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | DMPlug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .dashboard-card { @apply bg-white/5 border border-white/10 rounded-[32px] p-8 transition-all duration-300 hover:border-[#EFFF00]/30; }
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
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen" x-data="{ 
    documentModalOpen: false, 
    selectedPurchase: null,
    openEdit(purchase) {
        this.selectedPurchase = purchase;
        this.documentModalOpen = true;
    }
}">
    <x-header />

    <main class="container mx-auto px-6 md:px-16 py-12">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-10 bg-[#EFFF00]/10 border border-[#EFFF00]/20 text-[#EFFF00] px-8 py-4 rounded-3xl flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Left Column: User Profile & Wallet -->
            <div class="w-full lg:w-1/3 space-y-8">
                <div class="dashboard-card text-center">
                    <div class="w-24 h-24 bg-[#EFFF00] rounded-full mx-auto mb-6 flex items-center justify-center text-black text-3xl font-black">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h2 class="text-2xl font-bold mb-1">{{ $user->name }}</h2>
                    <p class="text-white/40 text-sm mb-8">{{ $user->email }}</p>
                    
                    <div class="h-px bg-white/5 mb-8"></div>
                    
                    <div class="text-left space-y-6">
                        <div>
                            <span class="text-white/20 text-[10px] font-bold uppercase tracking-widest block mb-2">Wallet Address</span>
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 font-mono text-sm break-all">
                                {{ $user->wallet_address ?? 'No wallet generated' }}
                            </div>
                        </div>
                        <div>
                            <span class="text-white/20 text-[10px] font-bold uppercase tracking-widest block mb-2">Total Balance</span>
                            <div class="text-3xl font-black text-[#EFFF00]">${{ number_format($user->balance, 2) }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-card bg-gradient-to-br from-[#EFFF00]/10 to-transparent border-[#EFFF00]/20">
                    <h3 class="text-xl font-bold mb-4">Quick Support</h3>
                    <p class="text-white/50 text-sm leading-relaxed mb-6">Need help with a purchase or document generation? Contact our verified support on WhatsApp.</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::where('key', 'whatsapp_number')->first()?->value ?? '+2348052923367') }}" target="_blank" class="w-full py-4 bg-[#EFFF00] text-black font-bold rounded-2xl flex items-center justify-center gap-2 hover:scale-[1.02] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp Support
                    </a>
                </div>
            </div>

            <!-- Right Column: Purchased Tools -->
            <div class="w-full lg:w-2/3 space-y-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-3xl font-bold tracking-tight">My <span class="text-[#EFFF00]">Tools</span></h2>
                    <span class="text-white/20 font-medium">{{ $purchases->count() }} items purchased</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($purchases as $purchase)
                        <div class="dashboard-card flex flex-col group">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0 bg-white/5 border border-white/5">
                                    @if($purchase->tool->image)
                                        <img src="{{ asset('storage/' . $purchase->tool->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-white/10">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-lg truncate group-hover:text-[#EFFF00] transition-colors">{{ $purchase->tool->name }}</h4>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#EFFF00] bg-[#EFFF00]/10 px-2 py-0.5 rounded">{{ $purchase->tool->category }}</span>
                                </div>
                            </div>

                            <p class="text-white/40 text-sm mb-8 line-clamp-2">
                                @if($purchase->tool->category === 'Websites')
                                    Files for this script are being sent to your email. Check your inbox and spam.
                                @else
                                    Provide the necessary details below to generate and download your document.
                                @endif
                            </p>

                            <div class="mt-auto">
                                @if($purchase->tool->category === 'Websites')
                                    <button disabled class="w-full py-4 bg-white/5 border border-white/10 text-white/20 font-bold rounded-2xl cursor-not-allowed">
                                        Email Dispatched
                                    </button>
                                @else
                                    <button @click="openEdit({{ json_encode($purchase) }})" class="w-full py-4 bg-white text-black font-bold rounded-2xl hover:bg-[#EFFF00] transition-all flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit & Generate
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">No purchases yet</h3>
                            <p class="text-white/40 mb-8">Browse our tools and start generating scripts today.</p>
                            <a href="{{ url('/') }}" class="inline-flex px-8 py-4 bg-[#EFFF00] text-black font-bold rounded-2xl hover:scale-[1.02] transition-all">Browse Tools</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <!-- Document Edit Modal -->
    <div x-show="documentModalOpen" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md" @click="documentModalOpen = false"></div>
        
        <div class="relative w-full max-w-4xl bg-[#0A0A0A] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="p-10 pb-0 flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold mb-2">New <span class="text-[#EFFF00]" x-text="selectedPurchase?.tool?.name"></span></h2>
                    <p class="text-white/50">Fill in the fields below to generate your document.</p>
                </div>
                <button @click="documentModalOpen = false" class="p-3 bg-white/5 rounded-full hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex-grow overflow-y-auto px-10 pb-10 custom-scrollbar">
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    <!-- Tabs Header -->
                    <div class="flex bg-white/5 p-1 rounded-2xl border border-white/10">
                        <button type="button" class="flex-1 py-3 bg-[#EFFF00] text-black font-bold rounded-xl">Edit Mode</button>
                        <button type="button" disabled class="flex-1 py-3 text-white/20 font-bold cursor-not-allowed">View Mode</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Surnanme -->
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                Surname
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </label>
                            <input type="text" name="surname" placeholder="e.g. Herwell" class="input-field">
                            <p class="text-[11px] text-white/20 italic">Enter your surname here.</p>
                        </div>

                        <!-- Given Name -->
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                Given Name
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </label>
                            <input type="text" name="given_name" placeholder="e.g. Marie R" class="input-field">
                            <p class="text-[11px] text-white/20 italic">Enter your first name and middle name.</p>
                        </div>

                        <!-- DOB -->
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                Date Of Birth
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </label>
                            <input type="text" name="dob" placeholder="e.g. 1989MAY12" class="input-field">
                            <p class="text-[11px] text-white/20 italic">Enter your date of birth.</p>
                        </div>

                        <!-- SSN -->
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                SSN Number
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </label>
                            <input type="text" name="ssn" placeholder="e.g. 056-42-7523" class="input-field">
                            <p class="text-[11px] text-white/20 italic">Enter your 9 digit Social Security Number.</p>
                        </div>

                        <!-- Pay Grade -->
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                Pay Grade
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </label>
                            <input type="text" name="pay_grade" placeholder="e.g. E5" class="input-field">
                            <p class="text-[11px] text-white/20 italic">Enter the pay grade associated with rank.</p>
                        </div>

                        <!-- Rank -->
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                Rank
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </label>
                            <input type="text" name="rank" placeholder="e.g. SGT" class="input-field">
                            <p class="text-[11px] text-white/20 italic">Enter the individual's military rank.</p>
                        </div>

                        <!-- Picture -->
                        <div class="col-span-full space-y-3">
                            <label class="flex items-center gap-2 text-sm font-bold text-white/70 ml-1">
                                Profile Picture
                                <svg class="w-4 h-4 text-[#EFFF00]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
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

                    <div class="pt-6 space-y-4">
                        <button type="submit" class="w-full py-5 bg-[#EFFF00] text-black font-extrabold text-lg rounded-2xl hover:scale-[1.02] transition-all shadow-xl shadow-[#EFFF00]/20">
                            Create Document
                        </button>
                        <button type="button" disabled class="w-full py-5 bg-white/5 border border-white/10 text-white/20 font-bold rounded-2xl cursor-not-allowed flex items-center justify-center gap-2">
                            Download Document
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="py-20 border-t border-white/5 text-center text-white/20 text-sm font-medium">
        &copy; {{ date('Y') }} DMPlug. All rights reserved.
    </footer>
    @livewireScripts
</body>
</html>

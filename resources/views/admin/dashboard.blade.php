<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | DMPlug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen" x-data="{ addToolModal: false, settingsModal: false, step: 'categories', selectedCategory: null }">
    <nav class="border-b border-white/5 px-6 py-4 flex justify-between items-center backdrop-blur-md sticky top-0 z-50">
        <h1 class="text-2xl font-bold tracking-tight">Admin <span class="text-[#EFFF00]">Dashboard</span></h1>
        <div class="flex items-center gap-6">
            <span class="text-white/50 text-sm">Welcome, {{ Auth::guard('admin')->user()->name }}</span>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white/50 hover:text-white transition-colors text-sm font-medium">Logout</button>
            </form>
        </div>
    </nav>

    @if (session('success'))
        <div class="max-w-4xl mx-auto mt-6 px-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="bg-[#EFFF00]/10 border border-[#EFFF00]/20 text-[#EFFF00] px-6 py-4 rounded-2xl flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-[#EFFF00]/50 hover:text-[#EFFF00]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    <main class="p-10 container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Total Users</h3>
                <p class="text-4xl font-bold">{{ number_format($totalUsers) }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Total Revenue</h3>
                <p class="text-4xl font-bold text-[#EFFF00]">${{ number_format($totalRevenue, 2) }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8">
                <h3 class="text-white/50 text-sm font-bold uppercase tracking-wider mb-2">Available Tools</h3>
                <p class="text-4xl font-bold">{{ number_format($availableTools) }}</p>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-xl font-bold mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('admin.users.index') }}" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300">
                    <div class="mb-4 text-[#EFFF00] group-hover:text-black transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold group-hover:text-black transition-colors">View Users</h4>
                    <p class="text-white/40 text-sm mt-1 group-hover:text-black/60 transition-colors">Manage registered accounts</p>
                </a>

                <button @click="addToolModal = true" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                    <div class="mb-4 text-[#EFFF00] group-hover:text-black transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold group-hover:text-black transition-colors">Add Tools</h4>
                    <p class="text-white/40 text-sm mt-1 group-hover:text-black/60 transition-colors">List a new product or tool</p>
                </button>
                <button @click="settingsModal = true" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                    <div class="mb-4 text-[#EFFF00] group-hover:text-black transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold group-hover:text-black transition-colors">Platform Settings</h4>
                    <p class="text-white/40 text-sm mt-1 group-hover:text-black/60 transition-colors">Configure global site options</p>
                </button>
            </div>
        </div>
    </main>

    <!-- Add Tool Modal -->
    <div x-show="addToolModal" 
         x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" @click="addToolModal = false"></div>
        
        <div class="relative w-full max-w-4xl bg-[#0A0A0A] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="p-10">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Choose <span class="text-[#EFFF00]">Category</span></h2>
                        <p class="text-white/50">Select the type of tool you want to add to the platform.</p>
                    </div>
                    <button @click="addToolModal = false; setTimeout(() => step = 'categories', 300)" class="p-3 bg-white/5 rounded-full hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Category Selection -->
                <div x-show="step === 'categories'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Website Category -->
                        <button @click="step = 'add-item'; selectedCategory = 'Websites'" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                            <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold group-hover:text-black transition-colors">Websites</h4>
                            <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Domain names and full sites</p>
                        </button>

                        <!-- Receipts Category -->
                        <button @click="step = 'add-item'; selectedCategory = 'Receipts'" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                            <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold group-hover:text-black transition-colors">Receipts</h4>
                            <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Payment and purchase proof</p>
                        </button>

                        <!-- ID Cards Category -->
                        <button @click="step = 'add-item'; selectedCategory = 'ID Cards'" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                            <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold group-hover:text-black transition-colors">ID Cards</h4>
                            <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Identity and license templates</p>
                        </button>

                        <!-- Tickets Category -->
                        <button @click="step = 'add-item'; selectedCategory = 'Tickets'" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                            <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold group-hover:text-black transition-colors">Tickets</h4>
                            <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Event and travel tickets</p>
                        </button>

                        <!-- Holding Paper Category -->
                        <button @click="step = 'add-item'; selectedCategory = 'Holding Paper'" class="group bg-white/5 border border-white/10 p-8 rounded-[30px] hover:bg-[#EFFF00] transition-all duration-300 text-left">
                            <div class="w-12 h-12 bg-[#EFFF00]/10 rounded-2xl flex items-center justify-center mb-6 text-[#EFFF00] group-hover:bg-black/10 group-hover:text-black transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold group-hover:text-black transition-colors">Holding Paper</h4>
                            <p class="text-white/40 text-sm mt-2 group-hover:text-black/60 transition-colors">Selfie with document images</p>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Add Item Form -->
            <div x-show="step === 'add-item'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="p-10 pt-0">
                <button @click="step = 'categories'" class="flex items-center gap-2 text-white/50 hover:text-[#EFFF00] mb-8 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Categories</span>
                </button>

                <form action="{{ route('admin.tools.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <input type="hidden" name="category" x-model="selectedCategory">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div x-show="selectedCategory === 'Websites'">
                                <label class="block text-sm font-medium text-white/50 mb-3">Website Type</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="relative flex items-center justify-center p-4 bg-white/5 border border-white/10 rounded-2xl cursor-pointer hover:bg-white/10 transition-all">
                                        <input type="radio" name="sub_category" value="Banking" class="sr-only peer" checked :disabled="selectedCategory !== 'Websites'">
                                        <div class="peer-checked:text-[#EFFF00] font-bold">Banking</div>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[#EFFF00] rounded-2xl"></div>
                                    </label>
                                    <label class="relative flex items-center justify-center p-4 bg-white/5 border border-white/10 rounded-2xl cursor-pointer hover:bg-white/10 transition-all">
                                        <input type="radio" name="sub_category" value="Investment" class="sr-only peer" :disabled="selectedCategory !== 'Websites'">
                                        <div class="peer-checked:text-[#EFFF00] font-bold">Investment</div>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[#EFFF00] rounded-2xl"></div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-white/50 mb-3" x-text="selectedCategory === 'Websites' ? 'Bank/Website Name' : 'Item Name'"></label>
                                <input type="text" name="name" id="name" required :placeholder="selectedCategory === 'Websites' ? 'e.g. Chase Bank, Binance' : 'e.g. Utility Bill, NY License'" 
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:border-[#EFFF00] transition-colors placeholder:text-white/20">
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-white/50 mb-3">Price (USD)</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-white/50">$</span>
                                    <input type="number" name="price" id="price" step="0.01" required placeholder="0.00" 
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-6 py-4 focus:outline-none focus:border-[#EFFF00] transition-colors placeholder:text-white/20">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-white/50 mb-3" x-text="selectedCategory + ' Image'"></label>
                                <div x-data="{ photoName: null, photoPreview: null }" class="relative">
                                    <input type="file" name="image" class="hidden" x-ref="photo"
                                        x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                        ">
                                    
                                    <div class="relative group cursor-pointer" x-on:click.prevent="$refs.photo.click()">
                                        <div x-show="!photoPreview" class="w-full aspect-video bg-white/5 border-2 border-dashed border-white/10 rounded-[30px] flex flex-col items-center justify-center group-hover:bg-white/10 group-hover:border-[#EFFF00]/50 transition-all">
                                            <svg class="w-12 h-12 text-white/20 mb-4 group-hover:text-[#EFFF00] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-white/40 text-sm font-medium">Click to upload <span x-text="selectedCategory"></span> image</p>
                                        </div>
                                        
                                        <div x-show="photoPreview" x-cloak class="w-full aspect-video rounded-[30px] overflow-hidden border border-white/10">
                                            <img :src="photoPreview" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity backdrop-blur-sm">
                                                <p class="text-[#EFFF00] font-bold">Change Image</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-white/50 mb-3">Description (Optional)</label>
                                <textarea name="description" id="description" rows="3" :placeholder="'Enter details about the ' + selectedCategory + '...'" 
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:border-[#EFFF00] transition-colors placeholder:text-white/20 resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="bg-[#EFFF00] text-black px-12 py-4 rounded-2xl font-bold hover:scale-105 active:scale-95 transition-all shadow-lg shadow-[#EFFF00]/20">
                            Create <span x-text="selectedCategory"></span> Listing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Settings Modal -->
    <div x-show="settingsModal" 
         x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" @click="settingsModal = false"></div>
        
        <div class="relative w-full max-w-xl bg-[#0A0A0A] border border-white/10 rounded-[40px] shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="p-10">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Platform <span class="text-[#EFFF00]">Settings</span></h2>
                        <p class="text-white/50 text-sm">Configure global application variables.</p>
                    </div>
                    <button @click="settingsModal = false" class="p-3 bg-white/5 rounded-full hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <label for="whatsapp_number" class="block text-sm font-medium text-white/50 mb-3">WhatsApp Funding Number</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-white/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </span>
                            <input type="text" name="whatsapp_number" id="whatsapp_number" required 
                                value="{{ \App\Models\Setting::where('key', 'whatsapp_number')->first()?->value ?? '+2348052923367' }}"
                                placeholder="+234..." 
                                class="w-full bg-white/5 border border-white/10 rounded-2xl pl-16 pr-6 py-4 focus:outline-none focus:border-[#EFFF00] transition-colors">
                        </div>
                        <p class="text-white/20 text-[11px] mt-4 font-medium italic">This number will be used for all 'Fund Wallet' WhatsApp redirections.</p>
                    </div>

                    <button type="submit" class="w-full bg-[#EFFF00] text-black py-5 rounded-2xl font-bold hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-[#EFFF00]/20">
                        Update Settings
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | DMPlug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glow-input:focus {
            box-shadow: 0 0 15px rgba(239, 255, 0, 0.3);
            border-color: #EFFF00;
        }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold tracking-tight mb-2">Admin <span class="text-[#EFFF00]">Portal</span></h1>
            <p class="text-white/50">Enter your credentials to manage DMPlug</p>
        </div>

        <!-- Login Card -->
        <div class="glass-card rounded-[40px] p-10 shadow-2xl">
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-2xl text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-sm font-medium text-white/70 mb-2 ml-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none glow-input transition-all duration-300"
                           placeholder="admin@dmplug.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-white/70 mb-2 ml-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none glow-input transition-all duration-300"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between ml-1">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/10 bg-white/5 text-[#EFFF00] focus:ring-0">
                        <span class="ml-2 text-sm text-white/50">Remember me</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-[#EFFF00] text-black font-bold py-4 rounded-2xl hover:bg-[#d9e600] transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-[#EFFF00]/10">
                    Sign In to Dashboard
                </button>
            </form>
        </div>

        <!-- Footer Link -->
        <div class="text-center mt-8">
            <a href="/" class="text-white/30 hover:text-white/60 transition-colors text-sm font-medium flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to website
            </a>
        </div>
    </div>
</body>
</html>

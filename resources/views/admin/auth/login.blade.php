<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In | Portfolio Studio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.classList.toggle('dark', savedTheme === 'dark');
            } catch (e) {}
        })();
    </script>
</head>
<body class="bg-[#F8FAFC] dark:bg-[#0c1017] text-gray-900 dark:text-gray-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-8 shadow-sm">
            <div class="text-center mb-8">
                <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-gradient-to-tr from-[#D96E17] to-[#fd853a] flex items-center justify-center text-white font-black text-lg shadow-sm">
                    SD
                </div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Portfolio Admin Engine</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Sign in to manage your portfolio, case studies & inquiries</p>
            </div>

            @if(session('info'))
                <div class="mb-5 p-3.5 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/60 text-blue-700 dark:text-blue-300 text-xs font-medium">
                    {{ session('info') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800/60 text-rose-700 dark:text-rose-300 text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@satyajeet.dev') }}" required autofocus
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800/80 px-3.5 py-2.5 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-[#D96E17] focus:ring-1 focus:ring-[#D96E17]"
                           placeholder="admin@example.com">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="password">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800/80 px-3.5 py-2.5 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-[#D96E17] focus:ring-1 focus:ring-[#D96E17]"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-gray-600 dark:text-gray-400 cursor-pointer">
                        <input type="checkbox" name="remember" value="1" class="rounded border-gray-300 text-[#D96E17] focus:ring-[#D96E17]">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full mt-2 py-2.5 px-4 rounded-lg bg-[#D96E17] hover:bg-[#c95f14] text-white font-semibold text-sm shadow-xs transition flex items-center justify-center gap-2">
                    <span>Authenticate & Access Studio</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-800 text-center text-xs text-gray-500 dark:text-gray-400">
                Default Credentials: <code class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300 font-mono text-[11px]">admin@satyajeet.dev / admin123</code>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Farah Raihanun Badiu</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css'])
</head>
<body class="bg-primary-50 min-h-screen flex items-center justify-center font-sans antialiased">

    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgba(224,69,123,0.12)] border border-white/50">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Admin Login</h1>
                <p class="text-gray-500 mt-2 text-sm">Masuk untuk mengelola portofolio</p>
            </div>

            @if($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all">
                </div>
                
                <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 rounded-xl transition-all shadow-md transform hover:-translate-y-0.5">
                    Masuk
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-primary-500 transition-colors">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Administrator | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center font-sans">
    
    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 border-t-8 border-red-600">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">ADMINISTRATOR</h2>
            <p class="text-gray-500 text-sm mt-2">Sistem Informasi Manajemen PKL</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                <strong class="font-bold">Akses Ditolak!</strong>
                <span class="block">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">USERNAME ADMIN</label>
                <input type="text" name="username" required autofocus 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all"
                    placeholder="Masukkan username admin">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">PASSWORD</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <button type="submit" 
                class="w-full py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-red-700 transition duration-300 shadow-lg transform hover:-translate-y-1">
                MASUK KE PANEL ADMIN
            </button>
        </form>

        <div class="mt-8 text-center border-t pt-4">
            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">
                &larr; Kembali ke Halaman Utama
            </a>
        </div>
    </div>

</body>
</html>
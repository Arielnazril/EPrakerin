<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Guru | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { 
            theme: { 
                extend: { 
                    colors: { 
                        'primary-blue': '#1e3a8a', 
                        'secondary-blue': '#2563eb' 
                    } 
                } 
            } 
        }
    </script>
</head>
<body class="bg-gradient-to-br from-primary-blue via-secondary-blue to-blue-500 h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8 border-t-4 border-primary-blue">
        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto mb-4 rounded-3xl bg-white shadow-md flex items-center justify-center border border-blue-100">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="w-14 h-14 object-contain">
            </div>
            <h2 class="text-2xl font-bold text-primary-blue">Login Guru Pembimbing</h2>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIP (Nomor Induk Pegawai)</label>
                <input type="text" name="username" required 
                       class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-secondary-blue focus:border-secondary-blue">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-secondary-blue focus:border-secondary-blue">
            </div>
            <button type="submit" 
                    class="w-full py-3 bg-secondary-blue text-white font-bold rounded-xl hover:bg-primary-blue transition">
                MASUK SEBAGAI GURU
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-secondary-blue">
                ← Kembali ke Login Siswa
            </a>
        </div>
    </div>
</body>
</html>

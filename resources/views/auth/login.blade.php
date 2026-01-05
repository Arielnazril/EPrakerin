<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Siswa | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1e3a8a',
                        'secondary-blue': '#2563eb',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center font-sans">
    <div class="container mx-auto px-4 h-full flex items-center justify-center">
        <div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden h-[85vh]">
            
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-blue to-blue-900 items-center justify-center relative overflow-hidden">
                <div class="relative z-10 text-center text-white px-8">
                    <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK" class="w-32 h-32 mx-auto mb-6 drop-shadow-lg animate-bounce-slow">
                    <h2 class="text-4xl font-extrabold mb-2 tracking-wide">e-Prakerin</h2>
                    <p class="text-blue-100 text-lg font-light">Sistem Informasi Manajemen Praktik Kerja Industri</p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white relative">
                <div class="w-full max-w-md">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Selamat Datang!</h2>
                        <p class="text-gray-500">Silakan masuk menggunakan akun Siswa</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Login Gagal!</strong>
                            <span class="block sm:inline">{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NIS (Nomor Induk Siswa)</label>
                            <input type="text" name="username" required autofocus placeholder="Contoh: 102030"
                                class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-secondary-blue focus:border-secondary-blue transition duration-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                            <input type="password" name="password" required placeholder="••••••••"
                                class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-secondary-blue focus:border-secondary-blue transition duration-300">
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 px-4 bg-secondary-blue hover:bg-primary-blue text-white font-bold rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.01]">
                            MASUK SEKARANG
                        </button>
                    </form>

                    <div class="relative flex py-6 items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink mx-4 text-gray-400 text-sm">Masuk Sebagai</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('login.guru') }}" 
                            class="w-full block py-3 px-4 border-2 border-secondary-blue rounded-xl font-bold text-secondary-blue hover:bg-blue-50 text-center transition duration-300">
                            LOGIN GURU
                        </a>
                        <a href="{{ route('login.industri') }}" 
                            class="w-full block py-3 px-4 border-2 border-gray-500 rounded-xl font-bold text-gray-600 hover:bg-gray-100 text-center transition duration-300">
                            LOGIN INDUSTRI
                        </a>
                    </div>

                    <div class="mt-8 text-center pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600">Belum punya akun?</p>
                        <a href="{{ route('register') }}" class="font-bold text-secondary-blue hover:underline">Daftar Akun Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
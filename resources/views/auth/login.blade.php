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
                    },
                    animation: {
                        'bounce-slow': 'bounce 3s infinite',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center font-sans py-10 px-4">

    <div class="w-full max-w-5xl">

        <div class="flex flex-col lg:flex-row w-full bg-white rounded-3xl shadow-2xl overflow-hidden">

            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-blue to-blue-900 items-center justify-center relative p-12">
                <div class="relative z-10 text-center text-white">
                    <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK"
                        class="w-32 h-32 mx-auto mb-6 drop-shadow-lg animate-bounce-slow">
                    <h2 class="text-4xl font-extrabold mb-2 tracking-wide">e-Prakerin</h2>
                    <p class="text-blue-100 text-lg font-light">Sistem Informasi Manajemen Praktik Kerja Industri</p>
                </div>
                <div class="absolute top-0 left-0 w-full h-full bg-white opacity-5 pointer-events-none"
                     style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
                <div class="w-full max-w-md">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Selamat Datang!</h2>
                        <p class="text-gray-500">Silakan masuk menggunakan akun Siswa</p>
                    </div>

                    @if (session('status_pending'))
                        <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow-sm animate-pulse">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-yellow-800">Menunggu Verifikasi</h3>
                                    <div class="mt-1 text-sm text-yellow-700">
                                        {{ session('status_pending') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-red-800">Login Gagal</h3>
                                    <p class="text-sm text-red-700 mt-1">{{ $errors->first() }}</p>
                                </div>
                            </div>
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

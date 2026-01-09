<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Prakerin | Sistem Informasi Praktik Kerja Industri</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a', // Blue 900
                        secondary: '#2563eb', // Blue 600
                        accent: '#fbbf24', // Amber 400
                    }
                }
            }
        }
    </script>
</head>

<body class="antialiased bg-gray-50 font-figtree">

    <nav class="bg-white shadow-sm fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-12 w-12">
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold text-primary leading-none">e-Prakerin</h1>
                        <p class="text-xs text-gray-500 tracking-wider">SMK BISA HEBAT</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700 hover:text-primary transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-semibold transition hidden sm:block">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary hover:bg-blue-800 text-white px-5 py-2.5 rounded-full font-bold shadow-lg transition transform hover:-translate-y-0.5">
                                    Daftar Siswa
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-white pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-blue-100 text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block">
                    Tahun Ajaran 2026/2027
                </span>
                <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    Kelola Kegiatan Magang <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Lebih Mudah & Modern</span>
                </h1>
                <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                    Platform terintegrasi yang menghubungkan Siswa, Guru Pembimbing, dan Mentor Industri untuk pemantauan kegiatan PKL yang efisien, transparan, dan real-time.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-primary text-white rounded-xl font-bold shadow-xl hover:bg-blue-800 transition flex items-center justify-center gap-2">
                            <i class="fas fa-tachometer-alt"></i> Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-primary text-white rounded-xl font-bold shadow-xl hover:bg-blue-800 transition flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                        </a>
                        <a href="#fitur" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 rounded-xl font-bold hover:bg-gray-50 transition flex items-center justify-center gap-2">
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="{{ asset('dokumen/panduan_prakerin.pdf') }}"
                        class="px-8 py-4 bg-blue-600 text-white rounded-xl font-bold
                                hover:bg-blue-700 active:bg-blue-800
                                shadow-sm hover:shadow-md
                                transition flex items-center justify-center gap-2"
                        target="_blank">
                            Panduan Kerja Praktek
                        </a>

                    @endauth
                </div>
            </div>
        </div>

        <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none opacity-30">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <div id="fitur" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Solusi Untuk Semua Pihak</h2>
                <p class="text-gray-600 mt-2">Satu aplikasi untuk mengintegrasikan seluruh proses magang.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-primary text-2xl mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Untuk Siswa</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Isi logbook harian digital, pantau kehadiran, dan lihat transkrip nilai langsung dari dashboard siswa yang responsif.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-green-600 text-2xl mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Untuk Guru</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Monitoring aktivitas siswa bimbingan secara real-time, validasi laporan, dan input nilai akademik dengan mudah.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 text-2xl mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Untuk Industri</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Mentor lapangan dapat memvalidasi logbook, memberikan feedback, dan menilai kinerja teknis & non-teknis siswa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-primary text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-extrabold mb-1">500+</div>
                    <div class="text-blue-200 text-sm font-medium">Siswa Magang</div>
                </div>
                <div>
                    <div class="text-4xl font-extrabold mb-1">40+</div>
                    <div class="text-blue-200 text-sm font-medium">Mitra Industri</div>
                </div>
                <div>
                    <div class="text-4xl font-extrabold mb-1">100%</div>
                    <div class="text-blue-200 text-sm font-medium">Digital Logbook</div>
                </div>
                <div>
                    <div class="text-4xl font-extrabold mb-1">24/7</div>
                    <div class="text-blue-200 text-sm font-medium">Akses Sistem</div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
    </div>

    <footer class="bg-blue-50 border-t border-blue-100 pt-6 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Baris atas: logo + brand & copyright -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Kiri: Logo + nama -->
            <div class="flex items-center gap-3">
                <div class="bg-white rounded-2xl p-2 shadow-sm border border-blue-100">
                    <img src="{{ asset('img/logo_smk.png') }}" alt="Logo"
                         class="h-14 w-14 rounded-xl object-cover">
                </div>
                <div>
                    <p class="text-blue-900 font-bold text-base sm:text-lg">e-Prakerin</p>
                    <p class="text-blue-400 text-xs tracking-widest font-semibold">
                        Sistem Informasi Manajemen Praktik Kerja Industri
                    </p>
                </div>
            </div>

            <!-- Kanan: copyright -->
            <p class="text-blue-400 text-xs sm:text-sm text-center md:text-right">
                &copy; {{ date('Y') }} SMK Al Madani Pontianak. Semua hak cipta dilindungi.
            </p>
        </div>

        <!-- Baris bawah: deskripsi tengah -->
        <div class="mt-3 border-t border-blue-100 pt-3">
            <p class="text-blue-400 text-xs sm:text-sm text-center max-w-3xl mx-auto">
                Platform e-Prakerin memfasilitasi kolaborasi siswa, guru, dan mitra industri
                dalam pelaksanaan Praktik Kerja Industri yang terarah, terukur, dan profesional.
            </p>

            <!-- Sosial media -->
            <div class="mt-3 flex items-center justify-center gap-6">
                <!-- Instagram -->
                <a href="https://www.instagram.com/smkalmadaniptk_official" target="_blank"
                   class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center
                                border border-blue-100 group-hover:border-blue-300 transition">
                        <img src="{{ asset('img/ic_instagram.png') }}" alt="Instagram"
                             class="w-4 h-4">
                    </div>
                    <span class="text-xs sm:text-sm text-blue-500 group-hover:text-blue-700 font-medium">
                        @smkalmadaniptk_official
                    </span>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/6285652104414" target="_blank"
                   class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center
                                border border-green-100 group-hover:border-green-300 transition">
                        <img src="{{ asset('img/ic_whatshapp.png') }}" alt="WhatsApp"
                             class="w-4 h-4">
                    </div>
                    <span class="text-xs sm:text-sm text-blue-500 group-hover:text-blue-700 font-medium">
                        +62 856-5210-4414
                    </span>
                </a>
            </div>
        </div>
    </div>
</footer>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>

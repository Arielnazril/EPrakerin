<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Siswa - e-Prakerin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex items-center justify-center py-10 px-4">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

        <div class="hidden md:flex md:w-1/3 bg-blue-900 text-white flex-col justify-between p-8 relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="bg-white p-2 rounded-lg">
                        <i class="fas fa-graduation-cap text-blue-900 text-xl"></i>
                    </div>
                    <span class="text-xl font-bold tracking-wide">e-Prakerin</span>
                </div>
                <h2 class="text-3xl font-bold mb-4 leading-tight">Mulai Perjalanan Karirmu Disini.</h2>
                <p class="text-blue-200 text-sm">Daftarkan dirimu untuk mengakses informasi magang, logbook digital, dan penilaian secara real-time.</p>
            </div>

            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 rounded-full bg-blue-800 opacity-50"></div>
            <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 rounded-full bg-blue-700 opacity-50"></div>

            <div class="relative z-10 text-xs text-blue-300">
                &copy; {{ date('Y') }} SMK Bisa Hebat.
            </div>
        </div>

        <div class="w-full md:w-2/3 p-8 md:p-10 relative">

            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Buat Akun Siswa</h3>
                <p class="text-gray-500 text-sm">Lengkapi data di bawah ini dengan benar.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm text-sm">
                    <p class="font-bold mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Perhatikan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <h4 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-3 border-b border-gray-100 pb-1">1. Informasi Akun</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Nama sesuai ijazah">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Username unik">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="email@sekolah.sch.id">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-3 border-b border-gray-100 pb-1 mt-2">2. Data Sekolah</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Contoh: 20241055">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                            <input type="text" name="kelas" value="{{ old('kelas') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Contoh: XII RPL 1">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jurusan Kompetensi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-book"></i>
                                </span>
                                <select name="jurusan_id" required class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white appearance-none">
                                    <option value="" disabled selected>-- Pilih Jurusan --</option>
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                            {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan ?? 'KJ' }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-3 border-b border-gray-100 pb-1 mt-2">3. Kontak</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">No. WhatsApp</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fab fa-whatsapp"></i>
                                </span>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Nama Jalan, Kelurahan, Kecamatan...">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wider mb-3">Keamanan Akun</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white" placeholder="********">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ulangi Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white" placeholder="********">
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-700 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition duration-300 shadow-lg transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline">Login disini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

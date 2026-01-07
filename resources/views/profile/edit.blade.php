@php
    $user = Auth::user();
    $layout = 'layouts.app';

    // 1. Tentukan Layout
    if($user->role == 'admin') {
        $layout = 'layouts.admin_layout';
    } elseif($user->role == 'siswa') {
        $layout = 'layouts.siswa_layout';
    } elseif($user->role == 'industri') {
        $layout = 'layouts.industri_layout';
    } elseif($user->role == 'guru') {
        $layout = 'layouts.guru_layout';
    }

    // 2. Tentukan Label Identitas (Supaya Dinamis)
    $labelIdentitas = 'Nomor Identitas';
    $placeholderIdentitas = 'Nomor ID';

    if($user->role == 'siswa') {
        $labelIdentitas = 'NIS (Nomor Induk Siswa)';
    } elseif($user->role == 'guru') {
        $labelIdentitas = 'NIP / NUPTK';
    } elseif($user->role == 'industri') {
        $labelIdentitas = 'NIK / ID Karyawan';
    }
@endphp

@extends($layout)

@section('page_title', 'Pengaturan Profil')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
            <p class="text-gray-500 text-sm">Kelola informasi akun dan data diri Anda.</p>
        </div>
        <div class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wide">
            Role: {{ $user->role }}
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="border-b pb-4 mb-6">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-id-card mr-2 text-blue-600"></i> Informasi Pribadi
            </h3>
        </div>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" required>
                    @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ $labelIdentitas }}</label>
                    <div class="relative">
                        <input type="text" value="{{ $user->nomor_identitas }}" class="w-full px-4 py-3 border border-gray-200 bg-gray-100 rounded-lg text-gray-500 cursor-not-allowed" readonly>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">*Hubungi Admin jika ingin mengubah nomor identitas.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" required>
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP / WhatsApp</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="08xxxxxxxxxx">
                    </div>
                    @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                @if($user->role == 'siswa')
                <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2">
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-3">Data Akademik</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Kelas</label>
                            <input type="text" value="{{ $user->kelas }}" class="w-full px-3 py-2 border border-gray-200 bg-gray-50 rounded text-sm text-gray-600" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Jurusan</label>
                            <input type="text" value="{{ $user->jurusan->nama_jurusan ?? '-' }}" class="w-full px-3 py-2 border border-gray-200 bg-gray-50 rounded text-sm text-gray-600" readonly>
                        </div>
                    </div>
                </div>
                @endif

                @if($user->role == 'industri')
                <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Instansi / Perusahaan</label>
                    <input type="text" value="{{ $user->instansi->nama_perusahaan ?? '-' }}" class="w-full px-4 py-3 border border-gray-200 bg-gray-100 rounded-lg text-gray-500" readonly>
                </div>
                @endif

            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2.5 px-6 rounded-lg hover:bg-blue-700 transition shadow-md flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Profil
                </button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold flex items-center">
                        <i class="fas fa-check-circle mr-1"></i> Data berhasil diperbarui.
                    </p>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="border-b pb-4 mb-6">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-key mr-2 text-yellow-500"></i> Ganti Password
            </h3>
            <p class="text-sm text-gray-500 mt-1">Gunakan kombinasi password yang aman.</p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 transition" autocomplete="current-password">
                    @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                    <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 transition" autocomplete="new-password">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 transition" autocomplete="new-password">
                    @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="bg-yellow-500 text-white font-bold py-2.5 px-6 rounded-lg hover:bg-yellow-600 transition shadow-md flex items-center">
                    <i class="fas fa-sync-alt mr-2"></i> Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold flex items-center">
                        <i class="fas fa-check-circle mr-1"></i> Password berhasil diubah.
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection

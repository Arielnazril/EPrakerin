@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Siswa')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.siswa.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Edit Siswa</h2>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $siswa->name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nomor_identitas" value="{{ $siswa->nomor_identitas }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jurusan</label>
                    <select name="jurusan_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ $siswa->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP / WA</label>
                    <input type="text" name="no_hp" value="{{ $siswa->no_hp }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="08...">
                </div>

                <div class="col-span-1 md:col-span-2 bg-yellow-50 p-4 rounded-lg border border-yellow-200 mt-2">
                    <h3 class="font-bold text-yellow-800 mb-2"><i class="fas fa-key mr-2"></i>Reset Password</h3>
                    <p class="text-sm text-yellow-700 mb-3">Isi kolom di bawah HANYA jika ingin mengganti password siswa ini. Jika tidak, biarkan kosong.</p>
                    <input type="password" name="password" class="w-full px-4 py-3 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan password baru...">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 shadow-lg transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

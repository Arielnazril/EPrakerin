@extends('layouts.admin_layout')

@section('page_title', 'Tambah Mentor Industri')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.pembimbing.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Form Tambah Mentor</h2>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.pembimbing.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Asal Perusahaan (Instansi) <span class="text-red-500">*</span></label>
                <select name="instansi_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                    <option value="" disabled selected>-- Pilih Perusahaan --</option>
                    @foreach($instansis as $instansi)
                        <option value="{{ $instansi->id }}">{{ $instansi->nama_perusahaan }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Jika perusahaan belum ada, tambahkan dulu di menu Data Industri.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Mentor</label>
                    <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="Contoh: Pak Hartono">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username Login</label>
                    <input type="text" name="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="mentor_telkom">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP</label>
                    <input type="text" name="no_hp" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="0812...">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="Minimal 6 karakter">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-[--color-primary-dark] text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-900 shadow-lg transition">
                    Simpan Mentor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.siswa_layout')

@section('page_title', 'Isi Logbook Baru')

@section('content')

<div class="max-w-3xl mx-auto">
    <a href="{{ route('siswa.logbook.history') }}" class="text-gray-500 hover:text-blue-600 mb-6 inline-flex items-center transition font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 px-8 py-5">
            <h2 class="text-white font-bold text-xl flex items-center">
                <i class="fas fa-pen-fancy mr-3"></i> Form Kegiatan Harian
            </h2>
            <p class="text-blue-100 text-sm mt-1 ml-8">Isi kegiatan magangmu dengan jujur dan lengkap.</p>
        </div>

        <form action="{{ route('siswa.logbook.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Kegiatan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jam Masuk</label>
                    <input type="time" name="jam_masuk" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jam Keluar</label>
                    <input type="time" name="jam_keluar" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kegiatan</label>
                <textarea name="kegiatan" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Memperbaiki bug pada fitur login, Melakukan instalasi kabel jaringan..." required></textarea>
                <p class="text-xs text-gray-500 mt-1 flex justify-between">
                    <span>Jelaskan secara detail.</span>
                    <span>Min. 10 karakter</span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Dokumentasi <span class="text-gray-400 font-normal">(Opsional)</span></label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 transition">
                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG. Maksimal ukuran 2MB.</p>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-[--color-primary-dark] text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-900 shadow-lg transition transform hover:-translate-y-1 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

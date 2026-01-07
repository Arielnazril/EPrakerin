@extends('layouts.guru_layout')

@section('page_title', 'Input Nilai Guru')

@section('content')

<div class="max-w-3xl mx-auto">
    <a href="{{ route('guru.penilaian.index') }}" class="text-gray-500 hover:text-blue-600 mb-6 inline-flex items-center transition font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-blue-700 px-8 py-6">
            <h2 class="text-white font-bold text-xl flex items-center">
                <i class="fas fa-book-reader mr-3"></i> Penilaian Laporan & Sidang
            </h2>
            <p class="text-blue-100 text-sm mt-1">Siswa: <span class="font-bold text-white">{{ $placement->siswa->name }}</span></p>
        </div>

        <form action="{{ route('guru.penilaian.store', $placement->id) }}" method="POST" class="p-8 space-y-8">
            @csrf

            <input type="hidden" name="nama_siswa" value="{{ $placement->siswa->name }}">

            <div>
                <h3 class="font-bold text-gray-800 border-b pb-2 mb-4 flex items-center text-lg">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                    Nilai Laporan Tertulis
                </h3>
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Skor Laporan (0-100)</label>
                    <input type="number" name="aspek_teknis" min="0" max="100" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-lg font-bold text-blue-700" placeholder="0" required>
                    <p class="text-xs text-gray-500 mt-2">
                        Dinilai berdasarkan: Kelengkapan bab, format penulisan, kerapian, dan isi laporan.
                    </p>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-gray-800 border-b pb-2 mb-4 flex items-center text-lg">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                    Nilai Presentasi / Sidang
                </h3>
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Skor Presentasi (0-100)</label>
                    <input type="number" name="aspek_non_teknis" min="0" max="100" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-lg font-bold text-blue-700" placeholder="0" required>
                    <p class="text-xs text-gray-500 mt-2">
                        Dinilai berdasarkan: Penguasaan materi, cara penyampaian, dan kemampuan menjawab pertanyaan.
                    </p>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-gray-800 border-b pb-2 mb-4 flex items-center text-lg">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                    Catatan Revisi (Opsional)
                </h3>
                <textarea name="catatan" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Perbaiki Bab 3 bagian metodologi..."></textarea>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-10 rounded-lg hover:bg-blue-700 shadow-xl transition transform hover:-translate-y-1 flex items-center" onclick="return confirm('Simpan nilai laporan & sidang? Data tidak bisa diubah.')">
                    <i class="fas fa-save mr-2"></i> Simpan Nilai Guru
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

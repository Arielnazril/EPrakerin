@extends('layouts.guru_layout')

@section('page_title', 'Edit Nilai Guru')

@section('content')

<div class="max-w-3xl mx-auto">
    <a href="{{ route('guru.penilaian.index') }}" class="text-gray-500 hover:text-blue-600 mb-6 inline-flex items-center transition font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-yellow-500 px-8 py-6">
            <h2 class="text-white font-bold text-xl flex items-center">
                <i class="fas fa-edit mr-3"></i> Edit Penilaian Laporan & Sidang
            </h2>
            <p class="text-yellow-100 text-sm mt-1">Siswa: <span class="font-bold text-white">{{ $penilaian->placement->siswa->name }}</span></p>
        </div>

        <form action="{{ route('guru.penilaian.update', $penilaian->id) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div>
                <h3 class="font-bold text-gray-800 border-b pb-2 mb-4 flex items-center text-lg">
                    <span class="bg-yellow-100 text-yellow-700 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                    Nilai Laporan Tertulis
                </h3>
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Skor (0-100)</label>
                    <input type="number" name="aspek_teknis" value="{{ $penilaian->aspek_teknis }}" min="0" max="100" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 text-lg font-bold text-gray-800" required>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-gray-800 border-b pb-2 mb-4 flex items-center text-lg">
                    <span class="bg-yellow-100 text-yellow-700 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                    Nilai Presentasi / Sidang
                </h3>
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Skor (0-100)</label>
                    <input type="number" name="aspek_non_teknis" value="{{ $penilaian->aspek_non_teknis }}" min="0" max="100" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 text-lg font-bold text-gray-800" required>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-gray-800 border-b pb-2 mb-4 flex items-center text-lg">
                    <span class="bg-yellow-100 text-yellow-700 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                    Catatan Revisi
                </h3>
                <textarea name="catatan" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">{{ $penilaian->catatan }}</textarea>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-yellow-500 text-white font-bold py-3 px-10 rounded-lg hover:bg-yellow-600 shadow-xl transition transform hover:-translate-y-1 flex items-center">
                    <i class="fas fa-save mr-2"></i> Update Nilai Guru
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

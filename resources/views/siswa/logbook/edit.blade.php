@extends('layouts.siswa_layout')

@section('page_title', 'Edit Logbook')

@section('content')

<div class="max-w-3xl mx-auto">
    <a href="{{ route('siswa.logbook.history') }}" class="text-gray-500 hover:text-blue-600 mb-6 inline-flex items-center transition font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Batal Edit
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-yellow-500 px-8 py-5">
            <h2 class="text-white font-bold text-xl flex items-center">
                <i class="fas fa-edit mr-3"></i> Edit Kegiatan
            </h2>
        </div>

        <form action="{{ route('siswa.logbook.update', $logbook->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $logbook->tanggal->format('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jam Masuk</label>
                    <input type="time" name="jam_masuk" value="{{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jam Keluar</label>
                    <input type="time" name="jam_keluar" value="{{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kegiatan</label>
                <textarea name="kegiatan" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" required>{{ $logbook->kegiatan }}</textarea>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                <label class="block text-sm font-bold text-gray-700 mb-2">Update Foto <span class="text-gray-400 font-normal">(Biarkan kosong jika tidak diganti)</span></label>

                @if($logbook->foto)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset('storage/' . $logbook->foto) }}" class="h-20 rounded border">
                    </div>
                @endif

                <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-yellow-100 file:text-yellow-700 hover:file:bg-yellow-200 transition">
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-yellow-500 text-white font-bold py-3 px-8 rounded-lg hover:bg-yellow-600 shadow-lg transition transform hover:-translate-y-1 flex items-center">
                    <i class="fas fa-save mr-2"></i> Update Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@extends('layouts.industri_layout')

@section('page_title', 'Detail Validasi')

@section('content')

<div class="max-w-4xl mx-auto">
    <a href="{{ route('industri.validasi.index') }}" class="text-gray-500 hover:text-purple-600 mb-6 inline-flex items-center transition font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
    </a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="md:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Detail Kegiatan Siswa</h3>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">
                    {{ $logbook->siswa->name }}
                </span>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between border-b pb-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Tanggal</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $logbook->tanggal->format('d F Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 uppercase font-bold">Jam Kerja</p>
                        <p class="font-mono text-gray-800">{{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold mb-2">Deskripsi Kegiatan</p>
                    <div class="bg-gray-50 p-4 rounded-lg text-gray-700 leading-relaxed whitespace-pre-line border border-gray-100">
                        {{ $logbook->kegiatan }}
                    </div>
                </div>

                @if($logbook->foto)
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold mb-2">Dokumentasi</p>
                    <img src="{{ asset('storage/' . $logbook->foto) }}" class="w-full h-auto rounded-lg border shadow-sm">
                </div>
                @endif
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 sticky top-24">
                <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Form Validasi</h3>

                <form action="{{ route('industri.validasi.update', $logbook->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status Validasi</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500" required>
                            <option value="disetujui" {{ $logbook->status == 'disetujui' ? 'selected' : '' }}>✅ Setujui</option>
                            <option value="ditolak" {{ $logbook->status == 'ditolak' ? 'selected' : '' }}>❌ Tolak / Revisi</option>
                            <option value="pending" {{ $logbook->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Pembimbing <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="catatan_pembimbing" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500" placeholder="Berikan masukan atau alasan penolakan...">{{ $logbook->catatan_pembimbing }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white font-bold py-3 rounded-lg hover:bg-purple-700 shadow-lg transition transform hover:-translate-y-1">
                        Simpan Validasi
                    </button>
                </form>

                @if($logbook->status == 'disetujui')
                    <div class="mt-4 p-3 bg-green-50 text-green-700 text-xs rounded border border-green-200 text-center">
                        <i class="fas fa-check-circle"></i> Logbook ini sudah disetujui.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

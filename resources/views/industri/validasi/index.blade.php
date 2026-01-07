@extends('layouts.industri_layout')

@section('page_title', 'Validasi Logbook')

@section('content')

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Logbook Siswa</h2>
            <p class="text-sm text-gray-500">Periksa dan validasi kegiatan harian siswa bimbingan Anda.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-purple-50 text-purple-900 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Nama Siswa</th>
                    <th class="px-6 py-4">Kegiatan</th>
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($logbooks as $logbook)
                <tr class="hover:bg-gray-50 transition {{ $logbook->status == 'pending' ? 'bg-yellow-50/50' : '' }}">
                    <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">
                        {{ $logbook->tanggal->format('d M Y') }}
                        <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $logbook->siswa->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ Str::limit($logbook->kegiatan, 50) }}
                    </td>
                    <td class="px-6 py-4">
                        @if($logbook->foto)
                            <a href="{{ asset('storage/' . $logbook->foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs font-bold">
                                <i class="fas fa-image"></i> Lihat Foto
                            </a>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($logbook->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold border border-yellow-200 animate-pulse">
                                Butuh Validasi
                            </span>
                        @elseif($logbook->status == 'disetujui')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold border border-green-200">
                                Disetujui
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-bold border border-red-200">
                                Ditolak
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('industri.validasi.show', $logbook->id) }}" class="bg-purple-600 text-white hover:bg-purple-700 px-4 py-2 rounded-lg text-xs font-bold shadow transition">
                            <i class="fas fa-search mr-1"></i> Periksa
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <i class="fas fa-clipboard-check text-4xl mb-3 text-gray-300"></i>
                        <p>Tidak ada data logbook dari siswa bimbingan Anda.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

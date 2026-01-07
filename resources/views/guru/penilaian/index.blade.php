@extends('layouts.guru_layout') {{-- Pastikan nanti buat layout guru --}}

@section('page_title', 'Penilaian Bimbingan')

@section('content')

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Penilaian Laporan & Sidang</h2>
            <p class="text-sm text-gray-500">Input nilai akademik untuk siswa bimbingan Anda.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-blue-50 text-blue-900 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Nama Siswa</th>
                    <th class="px-6 py-4">Industri</th>
                    <th class="px-6 py-4">Status Nilai Anda</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($placements as $placement)

                {{-- Cek apakah GURU ini sudah menilai? --}}
                @php
                    $sudahDinilai = \App\Models\Penilaian::where('placement_id', $placement->id)
                                    ->where('penilai_id', Auth::id())
                                    ->exists();
                @endphp

                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <span class="block font-bold text-gray-800">{{ $placement->siswa->name }}</span>
                        <span class="text-xs text-gray-500">{{ $placement->siswa->nomor_identitas }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <i class="fas fa-building mr-1 text-gray-400"></i> {{ $placement->instansi->nama_perusahaan }}
                    </td>
                    <td class="px-6 py-4">
                        @if($sudahDinilai)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                <i class="fas fa-check mr-1"></i> Selesai
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200 animate-pulse">
                                Belum Dinilai
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if(!$sudahDinilai)
                            <a href="{{ route('guru.penilaian.create', $placement->id) }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-xs font-bold shadow transition">
                                <i class="fas fa-pen-nib mr-1"></i> Input Nilai
                            </a>
                        @else
                            <button disabled class="text-gray-400 cursor-not-allowed font-bold text-xs">
                                Edit (Terkunci)
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        Tidak ada siswa aktif di bawah bimbingan Anda.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

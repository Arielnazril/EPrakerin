@extends('layouts.industri_layout')

@section('page_title', 'Penilaian Kinerja')

@section('content')

<div x-data="{ activeTab: 'aktif' }">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa Bimbingan</h2>
            <p class="text-sm text-gray-500">Kelola nilai siswa magang dan lihat riwayat alumni.</p>
        </div>

        <div class="flex bg-white p-1 rounded-lg border border-gray-200 mt-4 md:mt-0 shadow-sm">
            <button @click="activeTab = 'aktif'"
                :class="{ 'bg-purple-600 text-white shadow': activeTab === 'aktif', 'text-gray-500 hover:text-purple-600': activeTab !== 'aktif' }"
                class="px-4 py-2 rounded-md text-sm font-bold transition flex items-center">
                <i class="fas fa-user-clock mr-2"></i> Sedang Magang
            </button>
            <button @click="activeTab = 'riwayat'"
                :class="{ 'bg-purple-600 text-white shadow': activeTab === 'riwayat', 'text-gray-500 hover:text-purple-600': activeTab !== 'riwayat' }"
                class="px-4 py-2 rounded-md text-sm font-bold transition flex items-center ml-1">
                <i class="fas fa-history mr-2"></i> Riwayat Alumni
            </button>
        </div>
    </div>

    <div x-show="activeTab === 'aktif'" x-transition.opacity>
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100 bg-purple-50 text-purple-800 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-circle text-green-500 mr-2 text-[8px]"></i> Status: Aktif Magang
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4 text-center">Status Nilai</th>
                        <th class="px-6 py-4 text-center">Nilai Anda</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($placements as $placement)
                        @php
                            $nilai = \App\Models\Penilaian::where('placement_id', $placement->id)
                                ->where('penilai_id', Auth::id())
                                ->first();
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-800 block">{{ $placement->siswa->name }}</span>
                                <span class="text-xs text-gray-500">{{ $placement->siswa->nomor_identitas }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $placement->tanggal_mulai->format('d M y') }} - {{ $placement->tanggal_selesai->format('d M y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($nilai)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                        Sudah Dinilai
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold border border-red-200 animate-pulse">
                                        Belum Dinilai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">
                                {{ $nilai ? $nilai->nilai_akhir : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(!$nilai)
                                    <a href="{{ route('industri.penilaian.create', $placement->id) }}" class="text-purple-600 hover:text-purple-800 font-bold text-xs border border-purple-200 hover:bg-purple-50 px-3 py-1.5 rounded transition">
                                        <i class="fas fa-plus mr-1"></i> Input
                                    </a>
                                @else
                                    <a href="{{ route('industri.penilaian.edit', $nilai->id) }}" class="text-yellow-600 hover:text-yellow-800 font-bold text-xs border border-yellow-200 hover:bg-yellow-50 px-3 py-1.5 rounded transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-8 text-center text-gray-400 italic">Tidak ada siswa magang aktif saat ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="activeTab === 'riwayat'" style="display: none;" x-transition.opacity>
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100 bg-gray-50 text-gray-600 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-circle text-gray-400 mr-2 text-[8px]"></i> Arsip Alumni
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">Selesai Magang</th>
                        <th class="px-6 py-4 text-center">Nilai Akhir Anda</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($placementsHistory as $history)
                        @php
                            $nilaiFinal = \App\Models\Penilaian::where('placement_id', $history->id)
                                ->where('penilai_id', Auth::id())
                                ->first();
                        @endphp
                        <tr class="hover:bg-gray-50 transition opacity-75 hover:opacity-100">
                            <td class="px-6 py-4 font-bold text-gray-700">{{ $history->siswa->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $history->tanggal_selesai->format('d F Y') }}</td>
                            <td class="px-6 py-4 text-center text-lg font-bold text-purple-700">
                                {{ $nilaiFinal ? $nilaiFinal->nilai_akhir : '0' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($nilaiFinal)
                                    {{-- Tombol Edit (Kondisional: Jika Admin belum kunci total, masih bisa edit via link manual. Tapi di UI kita hidden aja biar aman/read only) --}}
                                    <span class="text-xs text-gray-400"><i class="fas fa-lock mr-1"></i> Terkunci</span>
                                @else
                                    <span class="text-xs text-red-400 italic">Data Kosong</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-8 text-center text-gray-400 italic">Belum ada riwayat alumni.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection

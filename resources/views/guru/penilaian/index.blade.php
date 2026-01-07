@extends('layouts.guru_layout')

@section('page_title', 'Integrasi Nilai')

@section('content')

{{-- AlpineJS untuk Tabs --}}
<div x-data="{ activeTab: 'aktif' }">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Rekapitulasi Nilai Bimbingan</h2>
            <p class="text-sm text-gray-500">Pantau nilai dari Industri dan input nilai Sekolah.</p>
        </div>

        <div class="flex bg-white p-1 rounded-lg border border-gray-200 mt-4 md:mt-0 shadow-sm">
            <button @click="activeTab = 'aktif'"
                :class="{ 'bg-blue-600 text-white shadow': activeTab === 'aktif', 'text-gray-500 hover:text-blue-600': activeTab !== 'aktif' }"
                class="px-4 py-2 rounded-md text-sm font-bold transition flex items-center">
                <i class="fas fa-chalkboard-teacher mr-2"></i> Sedang Magang
            </button>
            <button @click="activeTab = 'riwayat'"
                :class="{ 'bg-blue-600 text-white shadow': activeTab === 'riwayat', 'text-gray-500 hover:text-blue-600': activeTab !== 'riwayat' }"
                class="px-4 py-2 rounded-md text-sm font-bold transition flex items-center ml-1">
                <i class="fas fa-history mr-2"></i> Riwayat Bimbingan
            </button>
        </div>
    </div>

    <div x-show="activeTab === 'aktif'" x-transition.opacity>
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100 bg-blue-50 text-blue-800 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-circle text-green-500 mr-2 text-[8px]"></i> Status: Aktif
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Instansi</th>
                        <th class="px-6 py-4">Nilai Industri (50%)</th>
                        <th class="px-6 py-4">Nilai Sekolah (50%)</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($placements as $placement)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <span class="block font-bold text-gray-800">{{ $placement->siswa->name }}</span>
                            <span class="text-xs text-gray-500">{{ $placement->siswa->nomor_identitas }}</span>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $placement->instansi->nama_perusahaan }}
                        </td>

                        <td class="px-6 py-4">
                            @if($placement->nilai_mentor)
                                <div class="flex items-center">
                                    <span class="text-lg font-bold text-purple-700">{{ $placement->nilai_mentor->nilai_akhir }}</span>
                                    <i class="fas fa-check-circle text-green-500 ml-2 text-xs" title="Sudah dinilai Mentor"></i>
                                </div>
                            @else
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide border border-red-200">
                                    Menunggu Mentor
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @if($placement->nilai_guru)
                                <span class="text-lg font-bold text-blue-700">{{ $placement->nilai_guru->nilai_akhir }}</span>
                            @else
                                <span class="text-sm text-gray-400 italic">Belum Input</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($placement->is_completed)
                                <span class="text-xs font-bold text-gray-500"><i class="fas fa-lock"></i> Final</span>
                            @else
                                <a href="{{ route('guru.penilaian.create', $placement->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs border border-blue-200 hover:bg-blue-50 px-3 py-1.5 rounded transition">
                                    {{ $placement->nilai_guru ? 'Edit Nilai' : 'Input Nilai' }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-6 text-center text-gray-400 italic">Tidak ada siswa bimbingan aktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="activeTab === 'riwayat'" style="display: none;" x-transition.opacity>
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100 bg-gray-50 text-gray-600 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-archive text-gray-400 mr-2 text-[8px]"></i> Arsip Alumni
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Instansi</th>
                        <th class="px-6 py-4">Nilai Industri</th>
                        <th class="px-6 py-4">Nilai Sekolah</th>
                        <th class="px-6 py-4">Nilai Akhir (NA)</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($placementsHistory as $history)
                    <tr class="hover:bg-gray-50 transition opacity-80 hover:opacity-100">
                        <td class="px-6 py-4 font-bold text-gray-700">{{ $history->siswa->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $history->instansi->nama_perusahaan }}</td>

                        <td class="px-6 py-4 font-bold text-purple-700">
                            {{ $history->nilaiMentor ? $history->nilaiMentor->nilai_akhir : '-' }}
                        </td>

                        <td class="px-6 py-4 font-bold text-blue-700">
                            {{ $history->nilaiGuru ? $history->nilaiGuru->nilai_akhir : '-' }}
                        </td>

                        {{-- Nilai Akhir Total (Ambil dari DB atau Hitung Manual jika null) --}}
                        <td class="px-6 py-4 font-extrabold text-green-700 text-lg">
                            {{ $history->nilai_akhir_total ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-300">
                                <i class="fas fa-check-double mr-1"></i> Selesai
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-400 italic">Belum ada riwayat bimbingan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection

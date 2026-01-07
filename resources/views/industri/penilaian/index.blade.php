@extends('layouts.industri_layout')

@section('page_title', 'Penilaian Kinerja')

@section('content')

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Penilaian Siswa Magang</h2>
            <p class="text-sm text-gray-500">Berikan penilaian akhir kinerja siswa bimbingan Anda.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-purple-100 text-purple-900 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Nama Siswa</th>
                    <th class="px-6 py-4">NIS</th>
                    <th class="px-6 py-4">Periode</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($placements as $placement)

                {{-- Logic Cek di View: Apakah Mentor ini sudah memberi nilai? --}}
                @php
                    $sudahDinilai = \App\Models\Penilaian::where('placement_id', $placement->id)
                                    ->where('penilai_id', Auth::id())
                                    ->exists();
                @endphp

                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $placement->siswa->name }}</td>
                    <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $placement->siswa->nomor_identitas }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $placement->tanggal_mulai->format('d M Y') }} - {{ $placement->tanggal_selesai->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($sudahDinilai)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">
                                Belum Dinilai
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if(!$sudahDinilai)
                            <a href="{{ route('industri.penilaian.create', $placement->id) }}" class="bg-purple-600 text-white hover:bg-purple-700 px-4 py-2 rounded-lg text-xs font-bold shadow transition flex items-center justify-center w-fit mx-auto">
                                <i class="fas fa-star mr-2"></i> Nilai Sekarang
                            </a>
                        @else
                            <button disabled class="bg-gray-50 text-gray-400 px-4 py-2 rounded-lg text-xs font-bold cursor-not-allowed mx-auto border border-gray-200">
                                Terkunci
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        Tidak ada siswa aktif yang perlu dinilai saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@extends('layouts.admin_layout')

@section('page_title', 'Finalisasi Nilai')

@section('content')

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <h2 class="text-lg font-bold text-gray-800">Master Data Nilai Akhir</h2>
        <div class="text-xs text-gray-500 bg-white border px-3 py-1 rounded shadow-sm">
            <i class="fas fa-info-circle text-blue-500 mr-1"></i> Klik "Kunci Nilai" untuk menerbitkan nilai final.
        </div>
    </div>

    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4">Siswa</th>
                <th class="px-6 py-4">Mentor (Industri)</th>
                <th class="px-6 py-4">Guru (Sekolah)</th>
                <th class="px-6 py-4">Total Akhir</th>
                <th class="px-6 py-4 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($placements as $p)
            {{-- Helper logic sederhana untuk view --}}
            @php
                $nMentor = $p->penilaians->where('penilai.role', 'industri')->first();
                $nGuru   = $p->penilaians->where('penilai.role', 'guru')->first();
            @endphp

            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-bold text-gray-800">{{ $p->siswa->name }}</td>

                <td class="px-6 py-4">
                    @if($nMentor)
                        <span class="text-green-600 font-bold">{{ $nMentor->nilai_akhir }}</span>
                    @else
                        <span class="text-red-400 text-xs italic">Belum Input</span>
                    @endif
                </td>

                <td class="px-6 py-4">
                    @if($nGuru)
                        <span class="text-green-600 font-bold">{{ $nGuru->nilai_akhir }}</span>
                    @else
                        <span class="text-red-400 text-xs italic">Belum Input</span>
                    @endif
                </td>

                <td class="px-6 py-4 font-mono font-bold">
                    {{ $p->nilai_akhir_total ?? '-' }}
                </td>

                <td class="px-6 py-4 text-center">
                    @if($p->is_completed)
                        <span class="bg-gray-800 text-white px-3 py-1 rounded text-xs font-bold shadow-sm">
                            <i class="fas fa-lock mr-1"></i> TERKUNCI
                        </span>
                    @else
                        @if($nMentor && $nGuru)
                            <form action="{{ route('admin.rekap.finalize', $p->id) }}" method="POST" onsubmit="return confirm('Kunci nilai ini? Data tidak bisa diubah lagi.')">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white hover:bg-green-600 px-4 py-1.5 rounded text-xs font-bold shadow transition animate-pulse">
                                    <i class="fas fa-key mr-1"></i> KUNCI NILAI
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs cursor-not-allowed">Menunggu Data</span>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

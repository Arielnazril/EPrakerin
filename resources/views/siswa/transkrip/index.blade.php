@extends('layouts.siswa_layout')

@section('page_title', 'Transkrip Nilai Magang')

@section('content')

<div class="max-w-4xl mx-auto space-y-8">

    <div class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden relative">

        <div class="bg-gradient-to-r from-blue-900 to-blue-700 p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold tracking-wide">TRANSKRIP NILAI PRAKERIN</h1>
                    <p class="opacity-80 mt-1">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-extrabold">{{ $placement->nilai_akhir_total ?? '0.00' }}</div>
                    <div class="text-xs uppercase font-bold opacity-75">Nilai Akhir</div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4 text-sm border-t border-white/20 pt-4">
                <div>
                    <p class="opacity-60 text-xs uppercase">Nama Siswa</p>
                    <p class="font-bold text-lg">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="opacity-60 text-xs uppercase">Tempat Magang</p>
                    <p class="font-bold text-lg">{{ $placement->instansi->nama_perusahaan }}</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Rincian Penilaian</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-purple-50 p-5 rounded-lg border border-purple-100">
                    <h4 class="font-bold text-purple-800 mb-3 flex items-center">
                        <i class="fas fa-building mr-2"></i> Penilaian Industri
                    </h4>
                    @if($nilaiMentor)
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex justify-between">
                                <span>Aspek Teknis (Hard Skill)</span>
                                <span class="font-bold">{{ $nilaiMentor->aspek_teknis }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Aspek Non-Teknis (Soft Skill)</span>
                                <span class="font-bold">{{ $nilaiMentor->aspek_non_teknis }}</span>
                            </li>
                            <li class="flex justify-between pt-2 border-t border-purple-200 font-bold text-purple-900">
                                <span>Rata-rata Industri</span>
                                <span>{{ $nilaiMentor->nilai_akhir }}</span>
                            </li>
                        </ul>
                    @else
                        <p class="text-red-500 text-sm italic">Belum dinilai oleh Mentor.</p>
                    @endif
                </div>

                <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
                    <h4 class="font-bold text-blue-800 mb-3 flex items-center">
                        <i class="fas fa-school mr-2"></i> Penilaian Sekolah
                    </h4>
                    @if($nilaiGuru)
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex justify-between">
                                <span>Laporan Tertulis</span>
                                <span class="font-bold">{{ $nilaiGuru->aspek_teknis }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Presentasi / Sidang</span>
                                <span class="font-bold">{{ $nilaiGuru->aspek_non_teknis }}</span>
                            </li>
                            <li class="flex justify-between pt-2 border-t border-blue-200 font-bold text-blue-900">
                                <span>Rata-rata Sekolah</span>
                                <span>{{ $nilaiGuru->nilai_akhir }}</span>
                            </li>
                        </ul>
                    @else
                        <p class="text-red-500 text-sm italic">Belum dinilai oleh Guru.</p>
                    @endif
                </div>
            </div>

            <div class="mt-8 text-center">
                @if($placement->is_completed)
                    <div class="inline-block bg-green-100 text-green-800 px-6 py-3 rounded-xl border border-green-200">
                        <p class="text-xs uppercase font-bold mb-1">Status Kelulusan</p>
                        <p class="text-2xl font-extrabold">LULUS</p>
                        <p class="text-sm font-medium mt-1">Predikat:
                            @if($placement->nilai_akhir_total >= 90) A (Sangat Baik)
                            @elseif($placement->nilai_akhir_total >= 80) B (Baik)
                            @else C (Cukup) @endif
                        </p>
                    </div>
                @else
                    <div class="bg-yellow-50 text-yellow-800 px-4 py-3 rounded-lg border border-yellow-200 text-sm">
                        <i class="fas fa-info-circle mr-2"></i> Nilai belum difinalisasi Admin.
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 flex justify-end">
            @if($placement->is_completed)
                <button class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2.5 rounded-lg font-bold shadow-lg transition flex items-center">
                    <i class="fas fa-print mr-2"></i> Cetak Sertifikat
                </button>
            @else
                <button disabled class="bg-gray-300 text-gray-500 px-6 py-2.5 rounded-lg font-bold cursor-not-allowed flex items-center">
                    <i class="fas fa-lock mr-2"></i> Cetak Sertifikat
                </button>
            @endif
        </div>
    </div>

    @if($placement->is_completed || ($nilaiMentor && $nilaiGuru))
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500">
            <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                <i class="fas fa-comment-dots text-purple-500 mr-2"></i> Catatan Mentor
            </h4>
            <div class="bg-gray-50 p-4 rounded-lg italic text-gray-600 text-sm leading-relaxed">
                "{{ $nilaiMentor->catatan ?? 'Tidak ada catatan khusus.' }}"
            </div>
            <div class="mt-4 flex items-center">
                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-xs">
                    {{ substr($placement->mentor->name ?? 'M', 0, 1) }}
                </div>
                <div class="ml-3">
                    <p class="text-xs font-bold text-gray-900">{{ $placement->mentor->name ?? 'Mentor' }}</p>
                    <p class="text-[10px] text-gray-500">Pembimbing Lapangan</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
            <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                <i class="fas fa-quote-left text-blue-500 mr-2"></i> Evaluasi Guru
            </h4>
            <div class="bg-gray-50 p-4 rounded-lg italic text-gray-600 text-sm leading-relaxed">
                "{{ $nilaiGuru->catatan ?? 'Tidak ada catatan khusus.' }}"
            </div>
            <div class="mt-4 flex items-center">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                    {{ substr($placement->guru->name ?? 'G', 0, 1) }}
                </div>
                <div class="ml-3">
                    <p class="text-xs font-bold text-gray-900">{{ $placement->guru->name ?? 'Guru' }}</p>
                    <p class="text-[10px] text-gray-500">Pembimbing Sekolah</p>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

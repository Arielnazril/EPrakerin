@extends('layouts.guru_layout')

@section('page_title', 'Dashboard Guru')

@section('content')

<div class="bg-white rounded-xl shadow-lg border-l-4 border-blue-500 p-6 mb-6 flex flex-col md:flex-row justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, Bapak/Ibu Guru!</h2>
        <p class="text-gray-600 mt-1">Berikut adalah ringkasan aktivitas siswa bimbingan PKL Anda.</p>
    </div>
    <div class="mt-4 md:mt-0 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100 text-blue-700 font-bold">
        <i class="far fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-indigo-500 hover:shadow-xl transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Siswa Bimbingan</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalSiswa }}</h3>
            </div>
            <div class="p-3 bg-indigo-100 text-indigo-600 rounded-full">
                <i class="fas fa-user-graduate text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-yellow-500 hover:shadow-xl transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Belum Dinilai</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $belumDinilai }}</h3>
            </div>
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full animate-pulse">
                <i class="fas fa-exclamation-circle text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('guru.penilaian.index') }}" class="text-sm text-yellow-600 font-bold hover:underline">
                Input Nilai <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-green-500 hover:shadow-xl transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Selesai Dinilai</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $sudahDinilai }}</h3>
            </div>
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <i class="fas fa-check-double text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <h3 class="font-bold text-gray-800"><i class="fas fa-history mr-2"></i> Logbook Siswa Terbaru</h3>
        <span class="text-xs text-gray-500 bg-gray-200 px-2 py-1 rounded">5 Aktifitas Terakhir</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">Siswa</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Kegiatan</th>
                    <th class="px-6 py-3">Status Mentor</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentLogbooks as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $log->siswa->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $log->tanggal->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($log->kegiatan, 50) }}</td>
                    <td class="px-6 py-4">
                        @if($log->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">Menunggu</span>
                        @elseif($log->status == 'disetujui')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Disetujui</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                        Belum ada aktifitas terbaru dari siswa bimbingan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

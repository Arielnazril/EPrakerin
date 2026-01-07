@extends('layouts.industri_layout')

@section('page_title', 'Dashboard Mentor')

@section('content')

<div class="bg-white rounded-xl shadow-lg border-l-4 border-purple-500 p-6 mb-6 flex flex-col md:flex-row justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, Bapak/Ibu Mentor!</h2>
        <p class="text-gray-600 mt-1">Anda login sebagai Pembimbing Lapangan dari <span class="font-bold">{{ Auth::user()->instansi->nama_perusahaan ?? 'Instansi' }}</span>.</p>
    </div>
    <div class="mt-4 md:mt-0 bg-purple-50 px-4 py-2 rounded-lg border border-purple-100 text-purple-700 font-bold">
        <i class="far fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-blue-500 hover:shadow-xl transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Siswa Bimbingan</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalSiswa ?? 0 }}</h3>
            </div>
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-yellow-500 hover:shadow-xl transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Butuh Validasi</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $logbookPending ?? 0 }}</h3>
            </div>
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full animate-pulse">
                <i class="fas fa-bell text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('industri.validasi.index') }}" class="text-sm text-yellow-600 font-bold hover:underline">
                Lihat Logbook <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-green-500 hover:shadow-xl transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Aktifitas</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalLogbook ?? 0 }}</h3>
            </div>
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <i class="fas fa-file-alt text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <h3 class="font-bold text-gray-800"><i class="fas fa-history mr-2"></i> Aktifitas Siswa Terbaru</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">Siswa</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Kegiatan</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentLogbooks ?? [] as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $log->user->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $log->tanggal->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($log->kegiatan, 40) }}</td>
                    <td class="px-6 py-4">
                        @if($log->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">Menunggu</span>
                        @elseif($log->status == 'disetujui')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Disetujui</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('industri.validasi.show', $log->id) }}" class="text-blue-600 hover:underline text-xs font-bold">Periksa</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada aktifitas terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

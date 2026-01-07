@extends('layouts.siswa_layout') {{-- Pake layout baru --}}

@section('page_title', 'Dashboard Siswa')

@section('content')

<div class="bg-white rounded-xl shadow-lg border-l-4 border-green-500 p-6 mb-6 flex flex-col md:flex-row justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-gray-600 mt-1">Selamat datang di panel monitoring kegiatan magang.</p>
    </div>
    <div class="mt-4 md:mt-0 bg-green-50 px-4 py-2 rounded-lg border border-green-100 text-green-700 font-bold">
        <i class="fas fa-calendar-check mr-2"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

@if($placement)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-blue-500 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Logbook</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $logbookSummary['total'] }}</h3>
                </div>
                <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-green-500 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Disetujui</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $logbookSummary['disetujui'] }}</h3>
                </div>
                <div class="p-3 bg-green-100 text-green-600 rounded-full">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-yellow-500 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Menunggu</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $logbookSummary['pending'] }}</h3>
                </div>
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-purple-500 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Status Magang</p>
                    <h3 class="text-lg font-extrabold text-gray-800 mt-2 uppercase">{{ $placement->status }}</h3>
                </div>
                <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                    <i class="fas fa-business-time text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800"><i class="fas fa-building mr-2 text-blue-600"></i> Lokasi Magang</h3>
            </div>
            <div class="p-6">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-4 rounded-lg mr-4 text-blue-600">
                        <i class="far fa-building text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $placement->instansi->nama_perusahaan }}</h2>
                        <p class="text-gray-600 mt-1 text-sm"><i class="fas fa-map-marker-alt mr-1"></i> {{ $placement->instansi->alamat }}</p>
                        <div class="mt-3 flex gap-3 text-sm">
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full border border-blue-200">
                                <i class="fas fa-calendar-alt mr-1"></i> Mulai: {{ $placement->tanggal_mulai->format('d M Y') }}
                            </span>
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full border border-blue-200">
                                <i class="fas fa-flag-checkered mr-1"></i> Selesai: {{ $placement->tanggal_selesai->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800"><i class="fas fa-users mr-2 text-green-600"></i> Pembimbing</h3>
            </div>
            <div class="p-6 space-y-4">

                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-blue-200 text-blue-700 flex items-center justify-center font-bold mr-3">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Guru Sekolah</p>
                        <p class="font-semibold text-sm">{{ $placement->guru->name }}</p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-bold mr-3">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Mentor Industri</p>
                        @if($placement->mentor_id)
                            <p class="font-semibold text-sm">{{ $placement->mentor->name }}</p>
                        @else
                            <p class="text-red-500 text-xs italic font-bold">Belum ditentukan</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@else
    <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 border-yellow-400">
        <i class="fas fa-exclamation-circle text-6xl text-yellow-400 mb-4"></i>
        <h3 class="text-2xl font-bold text-gray-800">Menunggu Penempatan</h3>
        <p class="text-gray-600 mt-2 max-w-lg mx-auto">
            Akun kamu sudah aktif, tetapi Admin sekolah belum menentukan tempat magang kamu.
            Silakan tunggu atau hubungi Guru Pembimbing.
        </p>
    </div>
@endif

@endsection

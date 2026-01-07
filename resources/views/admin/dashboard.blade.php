@extends('layouts.admin_layout')

@section('page_title', 'Dashboard Administrator')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-xl shadow-lg border-l-4 border-[--color-primary-dark] p-6 flex flex-col md:flex-row justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, Admin!</h2>
            <p class="text-gray-600 mt-1">Panel kontrol untuk memantau kegiatan PKL dan Verifikasi Pendaftaran.</p>
        </div>
        <div class="mt-4 md:mt-0 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100 text-[--color-primary-dark] font-bold shadow-sm">
            <i class="far fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Siswa</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalSiswa }}</h3>
                </div>
                <div class="p-3 bg-blue-100 rounded-full text-blue-600 shadow-inner">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Guru Pembimbing</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalGuru }}</h3>
                </div>
                <div class="p-3 bg-green-100 rounded-full text-green-600 shadow-inner">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Mitra Industri</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalIndustri }}</h3>
                </div>
                <div class="p-3 bg-purple-100 rounded-full text-purple-600 shadow-inner">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Sedang Magang</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $siswaMagang }}</h3>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full text-yellow-600 shadow-inner">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-red-50 to-white">
            <div class="flex items-center">
                <div class="bg-red-100 p-2 rounded-lg mr-3">
                    <i class="fas fa-user-plus text-red-600"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Verifikasi Pendaftaran Siswa</h3>
                    <p class="text-xs text-gray-500">Siswa baru yang menunggu persetujuan akun</p>
                </div>
            </div>
            @if($siswaPending->count() > 0)
                <span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs font-bold animate-pulse">
                    {{ $siswaPending->count() }} Perlu Tindakan
                </span>
            @else
                <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold">
                    Semua Beres
                </span>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">NIS</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($siswaPending as $siswa)
                    <tr class="hover:bg-blue-50 transition duration-150">
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $siswa->name }}</td>
                        <td class="px-6 py-4 text-gray-600 font-mono">{{ $siswa->nomor_identitas }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">
                                {{ $siswa->jurusan->kode_jurusan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">
                            {{ $siswa->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-2">
                            <form action="{{ route('admin.siswa.verify', $siswa->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-green-600 shadow-md transition flex items-center">
                                    <i class="fas fa-check mr-2"></i> Terima
                                </button>
                            </form>

                            <form action="{{ route('admin.siswa.reject', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak dan menghapus data siswa ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-600 shadow-md transition flex items-center">
                                    <i class="fas fa-trash mr-2"></i> Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-clipboard-check text-5xl text-gray-200 mb-3"></i>
                                <p>Tidak ada pendaftaran baru yang perlu diverifikasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

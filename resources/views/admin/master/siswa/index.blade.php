@extends('layouts.admin_layout')

@section('page_title', 'Manajemen Data Siswa')

@section('content')
<div class="space-y-8">

    @if($siswaPending->count() > 0)
    <div class="bg-red-50 rounded-xl shadow border border-red-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-red-100 flex justify-between items-center bg-white">
            <div class="flex items-center text-red-600">
                <i class="fas fa-exclamation-circle text-xl mr-2 animate-pulse"></i>
                <h3 class="font-bold text-lg">Pendaftaran Baru (Butuh Verifikasi)</h3>
            </div>
            <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                {{ $siswaPending->count() }} Siswa
            </span>
        </div>
        <table class="w-full text-left border-collapse">
            <thead class="bg-red-100 text-red-800 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-3">Waktu Daftar</th>
                    <th class="px-6 py-3">Nama Siswa</th>
                    <th class="px-6 py-3">NIS</th>
                    <th class="px-6 py-3">Jurusan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-100 bg-white">
                @foreach($siswaPending as $siswa)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $siswa->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $siswa->name }}</td>
                    <td class="px-6 py-4">{{ $siswa->nomor_identitas }}</td>
                    <td class="px-6 py-4">{{ $siswa->jurusan->kode_jurusan ?? '-' }}</td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <form action="{{ route('admin.siswa.verify', $siswa->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 shadow flex items-center">
                                <i class="fas fa-check mr-1"></i> Terima
                            </button>
                        </form>

                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Tolak dan hapus pendaftaran ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-700 shadow flex items-center">
                                <i class="fas fa-times mr-1"></i> Tolak
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="px-6 py-6 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Data Siswa Aktif</h2>
                <p class="text-sm text-gray-500">Daftar siswa yang sudah resmi terdaftar di sistem.</p>
            </div>
            <div class="bg-blue-50 text-blue-800 px-4 py-2 rounded-lg font-bold text-sm">
                Total: {{ $siswaAktif->count() }} Siswa
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nama Siswa</th>
                    <th class="px-6 py-4">NIS</th>
                    <th class="px-6 py-4">Jurusan</th>
                    <th class="px-6 py-4">Email / Kontak</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($siswaAktif as $index => $siswa)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-400 text-sm">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-bold text-gray-800">
                        {{ $siswa->name }}
                        <span class="block text-[10px] font-normal text-green-600">● Akun Aktif</span>
                    </td>
                    <td class="px-6 py-4 font-mono text-sm">{{ $siswa->nomor_identitas }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">
                            {{ $siswa->jurusan->kode_jurusan ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $siswa->email }} <br>
                        <span class="text-xs text-gray-400">{{ $siswa->no_hp ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="bg-yellow-100 text-yellow-600 p-2 rounded-lg hover:bg-yellow-200 transition" title="Edit Data">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin hapus siswa aktif ini? Logbook dan nilainya akan ikut terhapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400 bg-gray-50">
                        Belum ada data siswa aktif. Silakan verifikasi pendaftaran baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

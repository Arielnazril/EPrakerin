@extends('layouts.admin_layout')

@section('page_title', 'Master Mentor Industri')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Mentor Lapangan</h2>
            <p class="text-sm text-gray-500">Pembimbing dari pihak industri/perusahaan.</p>
        </div>
        <a href="{{ route('admin.pembimbing.create') }}" class="bg-[--color-primary-dark] hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center">
            <i class="fas fa-user-tie mr-2"></i> Tambah Mentor
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">Nama Mentor</th>
                    <th class="px-6 py-4">Perusahaan (Instansi)</th>
                    <th class="px-6 py-4">Username Login</th>
                    <th class="px-6 py-4">Kontak</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($mentors as $mentor)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $mentor->name }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $mentor->instansi->nama_perusahaan ?? 'Tidak Terkait' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600 font-mono text-sm bg-gray-50 w-fit rounded">{{ $mentor->username }}</td>
                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $mentor->no_hp ?? '-' }}</td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <a href="{{ route('admin.pembimbing.edit', $mentor->id) }}" class="text-yellow-500 hover:text-yellow-600 p-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.pembimbing.destroy', $mentor->id) }}" method="POST" onsubmit="return confirm('Hapus mentor ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 p-2"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data mentor industri.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

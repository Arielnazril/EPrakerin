@extends('layouts.admin_layout')

@section('page_title', 'Master Data Guru')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Guru Pembimbing</h2>
            <p class="text-sm text-gray-500">Guru sekolah yang akan memonitor siswa PKL.</p>
        </div>
        <a href="{{ route('admin.guru.create') }}" class="bg-[--color-primary-dark] hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Tambah Guru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nama Guru</th>
                    <th class="px-6 py-4">NIP / Username</th>
                    <th class="px-6 py-4">Kontak</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($gurus as $index => $guru)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3 text-xs">
                                {{ substr($guru->name, 0, 2) }}
                            </div>
                            {{ $guru->name }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $guru->nomor_identitas }}</td>
                    <td class="px-6 py-4 text-gray-600 text-sm">
                        <i class="fab fa-whatsapp text-green-500 mr-1"></i> {{ $guru->no_hp ?? '-' }}
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <a href="{{ route('admin.guru.edit', $guru->id) }}" class="bg-yellow-100 text-yellow-600 hover:bg-yellow-200 p-2 rounded-lg transition" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Hapus guru {{ $guru->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 p-2 rounded-lg transition" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data guru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

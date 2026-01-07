@extends('layouts.admin_layout')

@section('page_title', 'Master Data Industri')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Mitra Industri</h2>
            <p class="text-sm text-gray-500">Perusahaan tempat siswa melakukan magang.</p>
        </div>
        <a href="{{ route('admin.instansi.create') }}" class="bg-[--color-primary-dark] hover:bg-blue-900 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform hover:-translate-y-0.5 transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Perusahaan
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($instansis as $instansi)
        <div class="bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 flex flex-col">
            <div class="p-6 flex-1">
                <div class="flex items-start justify-between">
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 text-xl font-bold mb-4">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="flex space-x-1">
                        <a href="{{ route('admin.instansi.edit', $instansi->id) }}" class="text-gray-400 hover:text-yellow-500 p-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.instansi.destroy', $instansi->id) }}" method="POST" onsubmit="return confirm('Hapus perusahaan {{ $instansi->nama_perusahaan }}?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 p-1"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $instansi->nama_perusahaan }}</h3>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2"><i class="fas fa-map-marker-alt mr-1"></i> {{ $instansi->alamat }}</p>

                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center"><i class="fas fa-envelope w-5 text-center mr-2 text-blue-400"></i> {{ $instansi->email_perusahaan ?? '-' }}</div>
                    <div class="flex items-center"><i class="fas fa-phone w-5 text-center mr-2 text-green-400"></i> {{ $instansi->telepon ?? '-' }}</div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-xs text-gray-500 flex justify-between items-center rounded-b-xl">
                <span>Terdaftar: {{ $instansi->created_at->diffForHumans() }}</span>
                <span class="font-bold text-blue-600">{{ $instansi->mentors_count ?? 0 }} Mentor</span>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-gray-400 bg-white rounded-xl border border-dashed border-gray-300">
            <i class="fas fa-city text-5xl mb-3 block opacity-50"></i>
            Belum ada data perusahaan.
        </div>
        @endforelse
    </div>
</div>
@endsection

@extends('layouts.admin_layout')

@section('page_title', 'Update Pembimbing Magang')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">

        <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800">Update Pembimbing: {{ $placement->siswa->name }}</h2>
            <p class="text-gray-600 text-sm mt-1">
                Lokasi Magang: <span class="font-bold">{{ $placement->instansi->nama_perusahaan }}</span>
            </p>
        </div>

        <form action="{{ route('admin.placement.update', $placement->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Guru Pembimbing</label>
                <select name="guru_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white" required>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}" {{ $placement->guru_id == $guru->id ? 'selected' : '' }}>
                            {{ $guru->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mentor Lapangan (Dari {{ $placement->instansi->nama_perusahaan }})</label>
                <select name="mentor_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white" required>
                    <option value="" disabled selected>-- Pilih Mentor --</option>
                    @foreach($mentors as $mentor)
                        <option value="{{ $mentor->id }}" {{ $placement->mentor_id == $mentor->id ? 'selected' : '' }}>
                            {{ $mentor->name }} ({{ $mentor->no_hp ?? '-' }})
                        </option>
                    @endforeach
                </select>

                @if($mentors->isEmpty())
                    <div class="mt-2 text-sm text-red-500 bg-red-50 p-2 rounded">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Belum ada data mentor untuk perusahaan ini.
                        <a href="{{ route('admin.pembimbing.create') }}" class="underline font-bold">Buat Akun Mentor Dulu</a>
                    </div>
                @endif
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('admin.placement.index') }}" class="text-gray-500 font-bold py-2 px-4 mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 shadow transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin_layout')

@section('page_title', 'Edit Mentor Industri')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.pembimbing.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Edit Mentor</h2>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.pembimbing.update', $mentor->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Asal Perusahaan</label>
                <select name="instansi_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                    @foreach($instansis as $instansi)
                        <option value="{{ $instansi->id }}" {{ $mentor->instansi_id == $instansi->id ? 'selected' : '' }}>
                            {{ $instansi->nama_perusahaan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Mentor</label>
                    <input type="text" name="name" value="{{ $mentor->name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ $mentor->username }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ $mentor->no_hp }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Kosongkan jika tidak ubah password">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-yellow-500 text-white font-bold py-3 px-8 rounded-lg hover:bg-yellow-600 shadow-lg transition">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

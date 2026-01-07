@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Industri')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.instansi.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Edit Perusahaan</h2>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.instansi.update', $instansi->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" value="{{ $instansi->nama_perusahaan }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Perusahaan</label>
                    <input type="email" name="email_perusahaan" value="{{ $instansi->email_perusahaan }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="telepon" value="{{ $instansi->telepon }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" required>{{ $instansi->alamat }}</textarea>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Website</label>
                    <input type="url" name="website" value="{{ $instansi->website }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <a href="{{ route('admin.instansi.index') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-600 font-bold hover:bg-gray-50 mr-3 transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-yellow-500 text-white font-bold hover:bg-yellow-600 shadow-lg transition">
                    <i class="fas fa-save mr-2"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin_layout')

@section('page_title', 'Tambah Industri Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.instansi.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Form Tambah Perusahaan</h2>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.instansi.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Perusahaan / Instansi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_perusahaan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="PT. Mencari Cinta Sejati" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Perusahaan</label>
                    <input type="email" name="email_perusahaan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="hrd@company.com">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="telepon" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="021-xxxxxx">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Jl. Jendral Sudirman No..." required></textarea>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Website (Opsional)</label>
                    <input type="url" name="website" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://www.company.com">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="reset" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-600 font-bold hover:bg-gray-50 mr-3 transition">Reset</button>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-[--color-primary-dark] text-white font-bold hover:bg-blue-900 shadow-lg transition transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

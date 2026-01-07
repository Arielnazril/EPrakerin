@extends('layouts.admin_layout')

@section('page_title', 'Tambah Guru Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.guru.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Form Tambah Guru</h2>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.guru.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Guru</label>
                    <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="Contoh: Budi Santoso, S.Kom">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">NIP (Sebagai Username Login)</label>
                    <input type="text" name="nip" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="198001...">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP / WhatsApp</label>
                    <input type="text" name="no_hp" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="0812...">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Akun</label>
                    <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="Minimal 6 karakter">
                    <p class="text-xs text-gray-400 mt-1">Guru akan login menggunakan NIP dan Password ini.</p>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-[--color-primary-dark] text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-900 shadow-lg transition">
                    Simpan Data Guru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

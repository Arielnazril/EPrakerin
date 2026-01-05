@extends('admin.partials.main_layout')

@section('page_title', 'Dashboard Administrator')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-xl shadow-lg border-l-4 border-[--color-primary-dark] p-6 flex flex-col md:flex-row justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, Admin!</h2>
            <p class="text-gray-600 mt-1">Ini adalah panel kontrol utama untuk memantau kegiatan PKL.</p>
        </div>
        <div class="mt-4 md:mt-0 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100 text-[--color-primary-dark] font-bold">
            <i class="far fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Siswa PKL</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">120</h3>
                </div>
                <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Guru Pembimbing</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">15</h3>
                </div>
                <div class="p-3 bg-green-100 rounded-full text-green-600">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Mitra Industri</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">42</h3>
                </div>
                <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-t-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Logbook Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 mt-1">85</h3>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-800"><i class="fas fa-history mr-2 text-[--color-primary-dark]"></i>Aktivitas Logbook Terbaru</h3>
            <a href="#" class="text-sm text-blue-600 hover:underline font-medium">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">Nama Siswa</th>
                        <th class="px-6 py-3">Industri</th>
                        <th class="px-6 py-3">Waktu</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">Budi Santoso</td>
                        <td class="px-6 py-4 text-gray-600">PT. Telkom Indonesia</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">10 Menit lalu</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-bold">Menunggu</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">Siti Aminah</td>
                        <td class="px-6 py-4 text-gray-600">CV. Kreatif Digital</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">25 Menit lalu</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold">Disetujui</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
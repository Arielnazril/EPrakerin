@extends('layouts.admin_layout')

@section('page_title', 'Data Penempatan Magang')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Plotting Siswa PKL</h2>
            <p class="text-sm text-gray-500">Kelola penempatan siswa, guru pembimbing, dan mentor industri.</p>
        </div>
        <a href="{{ route('admin.placement.create') }}" class="bg-[--color-primary-dark] hover:bg-blue-900 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg flex items-center transition transform hover:-translate-y-0.5">
            <i class="fas fa-plus-circle mr-2"></i> Plotting Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">Siswa</th>
                    <th class="px-6 py-4">Lokasi Magang (Instansi)</th>
                    <th class="px-6 py-4">Pembimbing</th>
                    <th class="px-6 py-4">Periode</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($placements as $placement)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">
                                {{ substr($placement->siswa->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">{{ $placement->siswa->name }}</div>
                                <div class="text-xs text-gray-500">{{ $placement->siswa->nomor_identitas }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $placement->instansi->nama_perusahaan }}</div>
                        <div class="text-xs text-gray-500">{{ Str::limit($placement->instansi->alamat, 20) }}</div>
                    </td>

                    <td class="px-6 py-4 text-sm">
                        <div class="flex flex-col space-y-2">
                            <span class="flex items-center text-gray-600" title="Guru Sekolah">
                                <i class="fas fa-chalkboard-teacher w-5 text-blue-500"></i>
                                {{ $placement->guru->name }}
                            </span>

                            @if($placement->mentor_id)
                                <span class="flex items-center text-gray-600" title="Mentor Industri">
                                    <i class="fas fa-user-tie w-5 text-purple-500"></i>
                                    {{ $placement->mentor->name }}
                                </span>
                            @else
                                <span class="flex items-center text-red-500 bg-red-50 px-2 py-1 rounded-md text-xs font-bold w-fit animate-pulse">
                                    <i class="fas fa-exclamation-circle w-5"></i>
                                    Belum Ada Mentor
                                </span>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-4 text-xs text-gray-600">
                        <div class="font-bold text-gray-700">{{ $placement->tanggal_mulai->format('d M Y') }}</div>
                        <div class="text-gray-400 text-[10px] uppercase font-bold mt-0.5">Sampai</div>
                        <div class="font-bold text-gray-700">{{ $placement->tanggal_selesai->format('d M Y') }}</div>
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($placement->status == 'aktif')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold border border-green-200">Sedang Magang</span>
                        @elseif($placement->status == 'selesai')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-bold border border-blue-200">Selesai</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-bold border border-red-200">Batal</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center flex justify-center space-x-2">
                        <a href="{{ route('admin.placement.edit', $placement->id) }}" class="text-yellow-500 hover:text-yellow-600 bg-yellow-50 hover:bg-yellow-100 p-2 rounded-lg transition" title="Update Guru/Mentor">
                            <i class="fas fa-user-edit"></i>
                        </a>

                        <form action="{{ route('admin.placement.destroy', $placement->id) }}" method="POST" onsubmit="return confirm('Batalkan penempatan ini? Siswa akan kembali berstatus belum magang.');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" title="Batalkan Plotting">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 bg-gray-50 border-dashed border-2 border-gray-200 rounded-lg m-4">
                        <i class="fas fa-map-marked-alt text-4xl mb-3 text-gray-300"></i>
                        <p>Belum ada siswa yang ditempatkan.</p>
                        <a href="{{ route('admin.placement.create') }}" class="text-blue-500 font-bold hover:underline mt-2 inline-block">Mulai Plotting Sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

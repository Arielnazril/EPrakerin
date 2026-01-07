@extends('layouts.siswa_layout')

@section('page_title', 'Riwayat Logbook')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Jurnal Kegiatan</h2>
            <p class="text-sm text-gray-500">Daftar kegiatan harian yang telah kamu kerjakan.</p>
        </div>
        <a href="{{ route('siswa.logbook.create') }}" class="bg-[--color-primary-dark] hover:bg-blue-900 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg flex items-center transition transform hover:-translate-y-0.5">
            <i class="fas fa-plus-circle mr-2"></i> Tulis Kegiatan
        </a>
    </div>

    <div class="space-y-4">
        @forelse($logbooks as $logbook)
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition duration-300">
            <div class="flex flex-col md:flex-row gap-6">

                <div class="md:w-1/6 flex flex-row md:flex-col justify-between md:justify-start border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                    <div class="text-center md:text-left">
                        <span class="block text-3xl font-bold text-gray-800">{{ $logbook->tanggal->format('d') }}</span>
                        <span class="block text-sm font-bold text-blue-600 uppercase tracking-wide">{{ $logbook->tanggal->format('M Y') }}</span>
                    </div>
                    <div class="text-right md:text-left md:mt-4">
                        <span class="block text-xs text-gray-400 font-bold uppercase">Jam Kerja</span>
                        <span class="block text-sm font-medium text-gray-700 bg-gray-100 px-2 py-1 rounded w-fit mt-1">
                            {{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}
                        </span>
                    </div>
                </div>

                <div class="md:w-4/6 space-y-3">
                    <h3 class="font-bold text-lg text-gray-800 flex items-center">
                        <i class="fas fa-clipboard-list mr-2 text-gray-400"></i> Deskripsi Kegiatan
                    </h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line text-sm">{{ $logbook->kegiatan }}</p>

                    @if($logbook->foto)
                        <div class="mt-3">
                            <p class="text-xs text-gray-400 mb-1 font-bold">Dokumentasi:</p>
                            <img src="{{ asset('storage/' . $logbook->foto) }}" alt="Bukti" class="h-24 w-auto rounded-lg border border-gray-200 object-cover hover:scale-105 transition cursor-pointer shadow-sm" onclick="window.open(this.src)">
                        </div>
                    @endif
                </div>

                <div class="md:w-1/6 flex flex-col justify-between items-end border-l border-gray-100 pl-4">

                    @if($logbook->status == 'disetujui')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold flex items-center border border-green-200">
                            <i class="fas fa-check-circle mr-1"></i> Valid
                        </span>
                    @elseif($logbook->status == 'ditolak')
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold flex items-center border border-red-200">
                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold flex items-center border border-yellow-200">
                            <i class="fas fa-hourglass-half mr-1"></i> Pending
                        </span>
                    @endif

                    @if($logbook->status == 'pending')
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('siswa.logbook.edit', $logbook->id) }}" class="text-yellow-500 hover:text-white hover:bg-yellow-500 border border-yellow-500 p-2 rounded-lg transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('siswa.logbook.destroy', $logbook->id) }}" method="POST" onsubmit="return confirm('Hapus logbook ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 border border-red-500 p-2 rounded-lg transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            @if($logbook->catatan_pembimbing)
                <div class="mt-4 bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500 text-sm">
                    <span class="font-bold text-blue-800 block mb-1"><i class="fas fa-comment-dots mr-1"></i> Catatan Mentor:</span>
                    "{{ $logbook->catatan_pembimbing }}"
                </div>
            @endif
        </div>
        @empty
        <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
            <i class="fas fa-book-reader text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-lg font-bold text-gray-600">Belum ada kegiatan</h3>
            <p class="text-gray-500 mb-6">Kamu belum mengisi logbook sama sekali.</p>
            <a href="{{ route('siswa.logbook.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                Mulai Isi Sekarang
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection

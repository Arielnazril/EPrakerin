<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    
                    {{-- Info Penempatan PKL --}}
                    @if(isset($placement))
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                            <p class="font-bold">Status PKL: Aktif</p>
                            <p>Lokasi: {{ $placement->instansi->nama_perusahaan }}</p>
                            <p>Mentor: {{ $placement->mentor->name }}</p>
                            <p>Guru Pembimbing: {{ $placement->guru->name }}</p>
                        </div>

                        <a href="{{ route('siswa.logbook.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Buka Buku Logbook
                        </a>
                    @else
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p>Anda belum ditempatkan (Plotting) oleh Admin.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
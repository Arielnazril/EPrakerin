<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Isi Kegiatan Harian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('siswa.logbook.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" required />
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="jam_masuk" :value="__('Jam Masuk')" />
                                <x-text-input id="jam_masuk" class="block mt-1 w-full" type="time" name="jam_masuk" required />
                            </div>
                            <div>
                                <x-input-label for="jam_keluar" :value="__('Jam Keluar')" />
                                <x-text-input id="jam_keluar" class="block mt-1 w-full" type="time" name="jam_keluar" required />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kegiatan" :value="__('Deskripsi Kegiatan')" />
                            <textarea id="kegiatan" name="kegiatan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto Dokumentasi (Opsional)')" />
                            <input type="file" name="foto" class="block mt-1 w-full border border-gray-300 rounded p-2">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Kirim Logbook') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
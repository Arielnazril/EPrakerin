@extends('layouts.admin_layout')

@section('page_title', 'Plotting Magang Baru')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="mb-6 flex items-center">
            <a href="{{ route('admin.placement.index') }}" class="mr-4 text-gray-500 hover:text-gray-700 transition">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Form Plotting Siswa</h2>
                <p class="text-sm text-gray-500">Hubungkan siswa dengan tempat magang dan pembimbingnya.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">

            <div class="h-1 w-full bg-gray-100">
                <div class="h-1 bg-[--color-primary-dark] w-1/3"></div>
            </div>

            <form action="{{ route('admin.placement.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                        <span
                            class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">1</span>
                        Data Siswa & Waktu
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Siswa (Yang Belum
                                Magang)</label>
                            <select name="siswa_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"
                                required>
                                <option value="" disabled selected>-- Cari Nama Siswa --</option>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">
                                        {{ $siswa->name }} ({{ $siswa->jurusan->kode_jurusan ?? 'No Jurusan' }})
                                    </option>
                                @endforeach
                            </select>
                            @if ($siswas->isEmpty())
                                <p class="text-xs text-red-500 mt-1">* Semua siswa sudah punya tempat magang.</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                        <span
                            class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">2</span>
                        Lokasi & Pembimbing
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Perusahaan / Instansi</label>
                            <select id="instansi_select" name="instansi_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white"
                                required onchange="filterMentors()">
                                <option value="" disabled selected>-- Pilih Perusahaan --</option>
                                @foreach ($instansis as $instansi)
                                    <option value="{{ $instansi->id }}">{{ $instansi->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Guru Pembimbing Sekolah</label>
                            <select name="guru_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white"
                                required>
                                <option value="" disabled selected>-- Pilih Guru --</option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mentor Lapangan</label>

                            <select id="mentor_select" name="mentor_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-100 cursor-not-allowed"
                                disabled>

                                <option value="" selected>-- Menyusul (Belum Ada Mentor) --</option>

                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" data-instansi="{{ $mentor->instansi_id }}"
                                        class="mentor-option hidden">
                                        {{ $mentor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1" id="mentor_hint">Pilih perusahaan dulu. Jika mentor belum
                                tahu, biarkan kosong.</p>
                        </div>

                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <button type="submit"
                        class="bg-[--color-primary-dark] text-white font-bold py-3 px-10 rounded-lg hover:bg-blue-900 shadow-xl transition transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> Simpan Penempatan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function filterMentors() {
            const instansiSelect = document.getElementById('instansi_select');
            const mentorSelect = document.getElementById('mentor_select');
            const mentorHint = document.getElementById('mentor_hint');
            const selectedInstansiId = instansiSelect.value;
            const mentorOptions = document.querySelectorAll('.mentor-option');

            // 1. Reset Dropdown Mentor
            mentorSelect.value = "";
            mentorSelect.disabled = false;
            mentorSelect.classList.remove('bg-gray-100', 'cursor-not-allowed');
            mentorSelect.classList.add('bg-white');

            // 2. Loop semua option mentor
            let countAvailable = 0;
            mentorOptions.forEach(option => {
                const mentorInstansi = option.getAttribute('data-instansi');

                if (mentorInstansi == selectedInstansiId) {
                    // Tampilkan jika instansi cocok
                    option.classList.remove('hidden');
                    // Hapus attribute disabled jika ada (untuk browser compatibility)
                    option.disabled = false;
                    countAvailable++;
                } else {
                    // Sembunyikan jika tidak cocok
                    option.classList.add('hidden');
                    option.disabled = true; // Supaya tidak bisa dipilih via keyboard
                }
            });

            // 3. Feedback Text
            if (countAvailable > 0) {
                mentorSelect.firstElementChild.textContent = `-- Pilih Salah Satu Mentor (${countAvailable} Tersedia) --`;
                mentorHint.textContent = "Mentor yang ditampilkan hanya yang bekerja di perusahaan tersebut.";
                mentorHint.classList.remove('text-red-500');
                mentorHint.classList.add('text-gray-500');
            } else {
                mentorSelect.firstElementChild.textContent = "-- Tidak Ada Mentor di Perusahaan Ini --";
                mentorHint.textContent =
                    "Perhatian: Belum ada akun Mentor untuk instansi ini. Silakan buat di menu Master Mentor.";
                mentorHint.classList.remove('text-gray-500');
                mentorHint.classList.add('text-red-500');
            }
        }
    </script>
@endsection

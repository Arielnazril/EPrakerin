@extends('layouts.admin_layout')

@section('page_title', 'Master Data Jurusan')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Jurusan</h2>
        <button onclick="openModal('addModal')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Jurusan
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nama Jurusan</th>
                    <th class="px-6 py-4">Kode</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($jurusans as $index => $jurusan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $jurusan->nama_jurusan }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">{{ $jurusan->kode_jurusan }}</span>
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <button onclick="openEditModal({{ $jurusan->id }}, '{{ $jurusan->nama_jurusan }}', '{{ $jurusan->kode_jurusan }}')"
                                class="bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600 transition shadow-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus jurusan ini? Data siswa terkait mungkin akan error.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition shadow-sm" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data jurusan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
        <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50 rounded-t-xl">
            <h3 class="font-bold text-lg text-gray-800">Tambah Jurusan Baru</h3>
            <button onclick="closeModal('addModal')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form action="{{ route('admin.jurusan.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Rekayasa Perangkat Lunak">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Jurusan</label>
                <input type="text" name="kode_jurusan" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: RPL">
            </div>
            <div class="flex justify-end pt-2">
                <button type="button" onclick="closeModal('addModal')" class="mr-2 px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-lg">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 shadow">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
        <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50 rounded-t-xl">
            <h3 class="font-bold text-lg text-gray-800">Edit Jurusan</h3>
            <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form id="editForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jurusan</label>
                <input type="text" id="edit_nama" name="nama_jurusan" required class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Jurusan</label>
                <input type="text" id="edit_kode" name="kode_jurusan" required class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div class="flex justify-end pt-2">
                <button type="button" onclick="closeModal('editModal')" class="mr-2 px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-lg">Batal</button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-yellow-600 shadow">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    // Logic untuk mengisi data ke Modal Edit secara dinamis
    function openEditModal(id, nama, kode) {
        // 1. Isi input value
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_kode').value = kode;

        // 2. Ganti URL Action Form
        // Kita buat URL dummy dulu, lalu replace ID-nya
        let url = "{{ route('admin.jurusan.update', ':id') }}";
        url = url.replace(':id', id);

        document.getElementById('editForm').action = url;

        // 3. Buka Modal
        openModal('editModal');
    }
</script>
@endsection

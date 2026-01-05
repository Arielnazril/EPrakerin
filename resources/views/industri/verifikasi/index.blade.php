<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi Logbook Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Kegiatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($logbooks as $log)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->siswa->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $log->siswa->username }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold">{{ $log->tanggal->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-700">{{ Str::limit($log->kegiatan, 100) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($log->status == 'pending')
                                        <span class="text-yellow-600 font-bold">Butuh Verifikasi</span>
                                    @elseif($log->status == 'disetujui')
                                        <span class="text-green-600 font-bold">Disetujui</span>
                                    @else
                                        <span class="text-red-600 font-bold">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($log->status == 'pending')
                                    <form action="{{ route('industri.verifikasi.update', $log->id) }}" method="POST" class="flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <button type="submit" name="status" value="disetujui" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">
                                            ACC
                                        </button>
                                        <button type="submit" name="status" value="ditolak" class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-1 px-2 rounded">
                                            Tolak
                                        </button>
                                    </form>
                                    @else
                                        <span class="text-xs text-gray-400">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
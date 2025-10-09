<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Rencana Studi (Drop Mata Kuliah)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="p-4 mb-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-gray-600 dark:text-gray-400">Status RPS Anda saat ini adalah <span class="font-bold text-yellow-500">Revisi</span>. Silakan drop mata kuliah yang tidak diperlukan sesuai catatan dari dosen Anda. Setelah selesai, ajukan kembali RPS Anda.</p>
                    
                    @if($rps->catatan_dosen)
                        <div class="p-4 mb-6 bg-yellow-50 dark:bg-gray-700 border-l-4 border-yellow-400">
                            <p class="font-bold text-gray-800 dark:text-gray-200">Catatan dari Dosen:</p>
                            <p class="italic text-gray-600 dark:text-gray-400">"{{ $rps->catatan_dosen }}"</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode MK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($rps->mataKuliah as $mk)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $mk->kode_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $mk->nama_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $mk->sks }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('mahasiswa.rps.drop', $mk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin drop mata kuliah ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    {{ __('Drop') }}
                                                </x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Tidak ada mata kuliah untuk di-drop.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Ajukan Ulang -->
                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6 flex justify-end">
                        <form action="{{ route('mahasiswa.rps.resubmit') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <x-primary-button>
                                {{ __('Ajukan Ulang RPS') }}
                            </x-primary-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


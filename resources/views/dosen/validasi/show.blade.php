<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Rencana Studi Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Bagian Detail Mahasiswa --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informasi Mahasiswa</h3>
                    <div class="mt-4 space-y-2">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                            <p class="text-md text-gray-800 dark:text-gray-200">{{ $rps->mahasiswa->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">NIM</p>
                            <p class="text-md text-gray-800 dark:text-gray-200">{{ $rps->mahasiswa->nim }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Mata Kuliah yang Diambil --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                     <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Mata Kuliah yang Diambil</h3>
                     <ul class="mt-4 list-disc list-inside space-y-2 text-gray-800 dark:text-gray-200">
                        @foreach($rps->mataKuliah as $mk)
                            <li>{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Bagian Aksi Validasi --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Aksi Validasi</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Setujui atau tolak Rencana Studi mahasiswa ini. Anda bisa menambahkan catatan jika menolak.
                    </p>
                    <div class="mt-6 flex items-start gap-4">
                        <!-- Form untuk Menyetujui -->
                        <form action="{{ route('dosen.validasi.update', $rps->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="disetujui">
                            <x-primary-button class="bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                                {{ __('Setujui RPS') }}
                            </x-primary-button>
                        </form>
                    </div>
                    <div class="mt-6">
                        <!-- Form untuk Menolak -->
                        <form action="{{ route('dosen.validasi.update', $rps->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="status" value="ditolak">
                            <div>
                                <x-input-label for="catatan_tolak" :value="__('Catatan (Wajib jika ditolak)')" />
                                <textarea id="catatan_tolak" name="catatan" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>
                            <x-danger-button>
                                {{ __('Tolak RPS') }}
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>


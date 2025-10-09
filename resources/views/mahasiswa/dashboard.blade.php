<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('success') }}
                </div>
            @endif
             @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Profil Anda</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nama</p>
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">NIM</p>
                            <p>{{ $mahasiswa->nim }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Program Studi</p>
                            <p>{{ $mahasiswa->program_studi }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dosen Wali</p>
                            <p>{{ $mahasiswa->dosenWali->name ?? 'Belum ditentukan' }}</p>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <h3 class="text-lg font-medium mb-2">Status Rencana Studi Semester Ini</h3>

                    @if ($rps)
                        <div class="flex items-center space-x-4">
                            <p class="text-sm">Status:</p>
                            @if($rps->status == 'disetujui')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @elseif($rps->status == 'diajukan')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Diajukan
                                </span>
                            @elseif($rps->status == 'revisi')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Revisi
                                </span>
                            @elseif($rps->status == 'ditolak')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                        
                        @if($rps->catatan_dosen)
                            <div class="mt-4 p-4 bg-yellow-50 dark:bg-gray-700 border-l-4 border-yellow-400">
                                <p class="font-bold text-gray-800 dark:text-gray-200">Catatan dari Dosen:</p>
                                <p class="italic text-gray-600 dark:text-gray-400">"{{ $rps->catatan_dosen }}"</p>
                            </div>
                        @endif

                        <div class="mt-6 flex space-x-4">
                            {{-- Tombol hanya muncul jika status disetujui --}}
                            @if($rps->status == 'disetujui')
                                <a href="{{ route('mahasiswa.rps.jadwal') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Lihat Jadwal
                                </a>
                            @endif

                            {{-- Tombol hanya muncul jika status revisi --}}
                            @if($rps->status == 'revisi')
                                <a href="{{ route('mahasiswa.rps.edit') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Edit RPS
                                </a>
                            @endif

                            {{-- TAMBAHAN: Tombol muncul jika status ditolak --}}
                            @if($rps->status == 'ditolak')
                                <a href="{{ route('mahasiswa.rps.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Isi Ulang RPS
                                </a>
                            @endif
                        </div>
                    
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Anda belum mengisi Rencana Studi untuk semester ini.</p>
                        <div class="mt-4">
                             <a href="{{ route('mahasiswa.rps.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Isi RPS Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


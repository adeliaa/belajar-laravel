<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);
?>
<form action="{{ route('profile.updatePassword', $profile->id_mahasiswa ? $profile->id_mahasiswa : $profile->id_user ) }}" method="POST">
    @csrf
    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">Edit Password</p>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
            <div class="mb-4">
                <label for="old_password" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Password</label>
                <input type="password" id="old_password" name="old_password" placeholder="Masukkan Password Anda" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                @error('old_password')
                <p id="old_password" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                @enderror
                @if(session('error'))
                <p id="old_password" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ session('error') }}</span></p>
                @endif

            </div>
        </div>
        <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
            <div class="mb-4">
                <label for="new_password" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Password Baru</label>
                <input type="password" name="new_password" placeholder="Masukkan Password Baru Anda" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                @error('new_password')
                <p id="new_password" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                @enderror
            </div>
        </div>
        <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
            <div class="mb-4">
                <button type="submit" class="focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">Simpan</button>
            </div>
        </div>
    </div>
</form>
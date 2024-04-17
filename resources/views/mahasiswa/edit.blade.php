@include('partials.sidebar')
<div class="w-full px-6 mx-auto">
    <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl" style="background-image: url('../../../assets/img/curved-images/red.jpg'); background-position-y: 50%">
        <span class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-purple-700 to-pink-500 opacity-60"></span>
    </div>
    @if(session('success'))
    <div id="bottomAlertContainer" class="fixed top-10 right-16 flex justify-center">
        <div id="bottomAlert" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div id="bottomAlertContainer" class="fixed top-10 right-16 flex justify-center">
        <div id="bottomAlert" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                @foreach($errors->all() as $error)
                <span class="font-medium">{{ $error }}</span>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="bottomAlertContainer" class="fixed top-10 right-16 flex justify-center">
        <div id="bottomAlert" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    </div>
    @endif


    <form method="POST" action="{{  route('profileMahasiswa', ['id' => $profile->id_user, 'action' => 'update']) }}">
        @csrf
        @method('POST')
        <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                        <img src="{{ asset('storage/img/profile/mahasiswa/' . $profile->photo) }}" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1">{{ old('name', $profile->name) }}</h5>
                        <p class="mb-0 font-semibold leading-normal text-sm">
                            @if(old('role', $profile->role) == 1)
                            Admin
                            @elseif(old('role', $profile->role) == 2)
                            Mentor
                            @elseif(old('role', $profile->role) == 3)
                            Mahasiswa
                            @else
                            Role Tidak Valid
                            @endif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full pt-6 pl-6 pr-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6">
                            <p class="leading-normal uppercase dark:text-white dark:opacity-70 text-sm">Informasi User</p>
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                    <div class="mb-4">
                                        <label for="nim" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">NIM</label>
                                        <input type="nim" name="nim" value="{{ old('nim', $profile->nim) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-50 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="name" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Nama</label>
                                        <input type="text" name="name" value="{{ old('name', $profile->name) }}" class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="name" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="institution" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Universitas/Sekolah</label>
                                        <input type="text" name="institution" value="{{ old('institution', $profile->institution) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-50 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="institution" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Email</label>
                                        <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="email" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="major" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Jurusan</label>
                                        <input type="text" name="major" value="{{ old('major', $profile->major) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-50 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="unit" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="phone_number" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">No.Telp</label>
                                        <input type="phone_number" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="phone_number" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="unit" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Unit</label>
                                        <input type="text" name="unit" value="{{ old('unit', $unit_name) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-50 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="unit" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="address" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Alamat</label>
                                        <input type="address" name="address" value="{{ old('address', $profile->address) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="address" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="division" class="inline-block mb-2 ml-1 font-bold text-sm text-slate-650 dark:text-white/80">Division</label>
                                        <input type="text" name="division" value="{{ old('division', $division_name) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-50 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly id="unit" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                    <div class="mb-4">
                                        <button type="button" id="edit" class="focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">Edit</button>
                                        <button type="submit" id="submit" class="hidden focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="w-full pt-6 pl-6 pr-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        @include('partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('profile.updatePhotoMahasiswa', $profile->id_user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full py-6 pl-6 pr-6 mx-auto mb-4">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Edit Foto Profil</label>
                            <input type="file" name="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX 5 MB).</p>
                            <button type="submit" id="submit" class="focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function toggleEdit() {
        var nameInput = document.getElementById("name");
        var emailInput = document.getElementById("email");
        var phone_numberInput = document.getElementById("phone_number");
        var addressInput = document.getElementById("address");
        var editButton = document.getElementById("edit");
        var submitButton = document.getElementById("submit");

        // Remove 'readonly' attribute from inputs
        nameInput.removeAttribute("readonly");
        emailInput.removeAttribute("readonly");
        phone_numberInput.removeAttribute("readonly");
        addressInput.removeAttribute("readonly");

        // Show 'Simpan' button and hide 'Edit' button
        submitButton.classList.remove('hidden');
        editButton.classList.add('hidden');
    }

    function saveChanges() {
        var nameInput = document.getElementById("name");
        var emailInput = document.getElementById("email");
        var phone_numberInput = document.getElementById("phone_number");
        var addressInput = document.getElementById("address");
        var editButton = document.getElementById("edit");
        var submitButton = document.getElementById("submit");

        // Add 'readonly' attribute back to inputs
        nameInput.setAttribute("readonly", true);
        emailInput.setAttribute("readonly", true);
        phone_numberInput.setAttribute("readonly", true);
        addressInput.setAttribute("readonly", true);

        // Hide 'Simpan' button and show 'Edit' button
        submitButton.classList.add('hidden');
        editButton.classList.remove('hidden');
    }

    // Attach click event listener to 'Edit' button
    document.getElementById('edit').addEventListener('click', toggleEdit);

    // Attach click event listener to 'Simpan' button
    document.getElementById('submit').addEventListener('click', saveChanges);

    //Fungsi untuk menampilkan alert
    setTimeout(function() {
        var alertContainer = document.getElementById('bottomAlertContainer');
        if (alertContainer) {
            alertContainer.parentNode.removeChild(alertContainer); // Hapus alert
        }
    }, 4000); // 20 detik
</script>
</script>
@include('partials.footer')
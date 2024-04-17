<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class LoginController extends ProfileController
{

    public function manualAuth(Request $request)
    {
        // Simpan informasi pengguna secara manual ke dalam session
        $request->session()->put('id', 1); // Atur ID pengguna
        $request->session()->put('role', 3); // Atur peran (role) pengguna
        $request->session()->put('email', 'example@example.com'); // Atur alamat email pengguna

        // Redirect ke halaman yang sesuai

        // return view('admin.edit');
    }
    // private function customVerifyCredentials($credentials)
    // {
    //     // Logika verifikasi kredensial pengguna
    //     // Misalnya, Anda dapat menggunakan model User untuk melakukan verifikasi
    //     $user = User::where('email', $credentials['email'])->first();

    //     // Verifikasi apakah pengguna ditemukan dan password cocok
    //     return $user && Hash::check($credentials['password'], $user->password);
    // }
}

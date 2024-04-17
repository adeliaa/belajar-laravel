<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function AdminProfile(Request $request, $id, $action = 'edit')
    {
        $profile = User::where('id_user', $id)->firstOrFail();
        if ($profile) {
            if ($profile->role == '1') {
                if ($action === 'update' && $request->isMethod('post')) {
                    $validator = $profile->validateData($request->all(), $id);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $profile->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'id_unit' => $request->id_unit ?? $profile->id_unit,
                        'id_division' => $request->id_division ?? $profile->id_division,
                    ]);
                    return redirect()->back()->with('success', 'Profile updated successfully.');
                } else {
                    $id_unit = $profile->id_unit;
                    $id_division = $profile->id_division;
                    $unit_name = DB::table('unit')->where('id_unit', $id_unit)->value('name');
                    $division_name = DB::table('division')->where('id_division', $id_division)->value('name');
                    $units = DB::table('unit')->pluck('name', 'id_unit');
                    $divisions = DB::table('division')->pluck('name', 'id_division');
                    return view('admin.edit', compact('profile', 'unit_name', 'division_name', 'units', 'divisions'));
                }
            } else {
                return response()->json(['error' => 'Unauthorized Access'], 401);
                //return redirect()->route('mentorProfile', ['id' => $id, 'action' => 'edit'])->with('error', 'Anda tidak memiliki izin untuk memperbarui profil pengguna ini.');
            }
        }
    }

    public function mentorProfile(Request $request, $id, $action = 'edit')
    {
        $profile = User::where('id_user', $id)->firstOrFail();
        if ($profile) {
            if ($profile->role == '2') {
                if ($action === 'update' && $request->isMethod('post')) {
                    $validator = $profile->validateData($request->all(), $id);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $profile->update([
                        'name' => $request->name,
                        'email' => $request->email,
                    ]);

                    return redirect()->back()->with('success', 'Profile updated successfully.');
                } else {

                    $id_unit = $profile->id_unit;
                    $id_division = $profile->id_division;
                    $unit_name = DB::table('unit')->where('id_unit', $id_unit)->value('name');
                    $division_name = DB::table('division')->where('id_division', $id_division)->value('name');
                    $units = DB::table('unit')->pluck('name', 'id_unit');
                    return view('mentor.edit', compact('profile', 'unit_name', 'division_name', 'units'));
                }
            } else {
                return response()->json(['error' => 'Unauthorized Access'], 401);
                //return redirect()->route('mentorProfile', ['id' => $id, 'action' => 'edit'])->with('error', 'Anda tidak memiliki izin untuk memperbarui profil pengguna ini.');
            }
        }
    }

    public function mahasiswaProfile(Request $request, $id, $action = 'edit')
    {
        $profile = Mahasiswa::where('id_mahasiswa', $id)->firstOrFail();
        if ($profile) {
            if ($action === 'update' && $request->isMethod('post')) {
                $validator = $profile->validate($request->all(), $id);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $profile->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                ]);

                return redirect()->back()->with('success', 'Profile updated successfully.');
            } else {
                $id_unit = $profile->id_unit;
                $id_division = $profile->id_division;
                $unit_name = DB::table('unit')->where('id_unit', $id_unit)->value('name');
                $division_name = DB::table('division')->where('id_division', $id_division)->value('name');
                //  $units = DB::table('unit')->pluck('name', 'id_unit');
                return view('mahasiswa.edit', compact('profile', 'unit_name', 'division_name'));
            }
        }
    }

    public function updatePassword(Request $request, $id)
    {
        // Lakukan pengecekan apakah pengguna adalah admin atau mahasiswa
        if ($this->isAdmin()) {
            $profile = user::findOrFail($id);
        } else {
            $profile = Mahasiswa::findOrFail($id);
        }

        // Validasi data yang dikirimkan
        $request->validate([
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|different:old_password',
        ]);

        // Periksa apakah password lama cocok dengan yang tersimpan di database
        if ($profile->checkOldPassword($request->old_password)) {
            // Jika cocok, hash password baru sebelum menyimpannya
            $hashedNewPassword = Hash::make($request->new_password);

            // Update password baru ke dalam basis data
            $profile->changePassword($hashedNewPassword);

            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            // Jika tidak cocok, beri pesan error
            return redirect()->back()->with('error', 'Password salah, silahkan coba kembali.');
        }
    }

    // Metode untuk mengecek apakah pengguna memiliki peran sebagai admin
    private function isAdmin()
    {
        // $user = Auth::user();
        // if ($user) {
        //     return $user->role === '1' || $user->role === '2';
        // }
        // return false;
        return true;
    }
    public function updatePhoto(Request $request, $id_user)
    {
        // Validasi request untuk memastikan file foto telah disertakan
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        // Cek apakah user dengan id tertentu ada
        $user = user::find($id_user);
        if (!$user) {
            return redirect()->back()->with('error', 'User Not Found.');
        }

        // Proses penyimpanan foto
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = $id_user . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/profile/user', $fileName, 'public'); // Simpan foto di storage yang sesuai, misalnya 'public/photos/mahasiswa'

            // Update kolom photo di tabel user dengan nama file foto
            $user->photo = $fileName;
            $user->save();

            return redirect()->back()->with('success', 'Photo updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update photo.');
    }
    public function updatePhotoMahasiswa(Request $request, $id_user)
    {
        // Validasi request untuk memastikan file foto telah disertakan
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Cek apakah user dengan id tertentu ada
        $user = Mahasiswa::find($id_user);
        if (!$user) {
            return redirect()->back()->with('error', 'User Not Found.');
        }

        // Proses penyimpanan foto
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = $id_user . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/profile/mahasiswa', $fileName, 'public'); // Simpan foto di storage yang sesuai, misalnya 'public/photos/mahasiswa'

            // Update kolom photo di tabel user dengan nama file foto
            $user->photo = $fileName;
            $user->save();

            return redirect()->back()->with('success', 'Photo updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update photo.');
    }
}

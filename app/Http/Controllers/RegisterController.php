<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }
    public function indexAdmin() {
        return view('auth.registeradmin');
    }

    public function registerUser(Request $request) {
        // Memeriksa apakah ada file yang diunggah
        // Jika ada file yang diunggah, ambil ekstensi file yang diunggah
        $extension = $request->file('imguser')->extension();

        // Buat nama file baru dengan format yang Anda inginkan
        $fileName = time() .'user_' . $request->username .  '.' . $extension;

        // Simpan gambar dengan nama file kustom
        $path = $request->file('imguser')->storeAs('user/photos', $fileName, 'public');

        if ($request->hasFile('imguser')) {
            // Gunakan path gambar yang diunggah
            $imgPath = 'storage/' . $path;
        } else {
            // Jika tidak ada file yang diunggah, gunakan gambar default
            $imgPath = 'img/user.png';
        }

        // Buat user baru dengan data yang diterima dari request
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'alamat' => $request->alamat,
            'imguser' => $imgPath,
        ]);

        // Assign role 'peminjam' kepada user baru
        $user->assignRole('peminjam');

        // Buat token untuk verifikasi email
        $token = Str::random(64);

        // Simpan token verifikasi
        UserVerify::create([
            'userid' => $user->userid,
            'token' => $token
        ]);

        // Kirim email verifikasi
        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        // Redirect ke halaman login setelah proses registrasi selesai
        return redirect()->route('login');
    }



    public function registerAdmin(Request $request) {

        // Ambil ekstensi file yang diunggah
        $extension = $request->file('imguser')->extension();

        // Buat nama file baru dengan format yang Anda inginkan
        $fileName = time() .'admin_' . $request->username .  '.' . $extension;

        // Simpan gambar dengan nama file kustom
        $path = $request->file('imguser')->storeAs('admin/photos', $fileName, 'public');


        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'alamat' => $request->alamat,
            'imguser' => 'storage/' . $path,
        ]);

        $user->assignRole('admin');

        $token = Str::random(64);

        UserVerify::create([
              'userid' => $user->userid,
              'token' => $token
            ]);

        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });

        return redirect()->route('login');
        // dd($request);

    }


    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

      return redirect()->route('login')->with('message', $message);
    }
}

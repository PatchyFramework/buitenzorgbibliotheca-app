<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
    
        return view('dashboard.users', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Simpan gambar
        $fileName = $request->file('imguser')->getClientOriginalName();
        $path = $request->file('imguser')->storeAs('user/photos', $fileName, 'public');
        
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'alamat' => $request->alamat,
            'imguser' => 'storage/' . $path,
            'email_verified_at' => 1,
        ]);
        
        $user->assignRole('petugas');

        $token = Str::random(64);
  
        UserVerify::create([
              'userid' => $user->userid, 
              'token' => $token
            ]);
  
        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });
    
        // Redirect ke halaman indeks buku
        return redirect()->route('users.index'); 
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user = User::all();
 
    	// $pdf = Pdf::loadView('pdfs.laporan', compact('buku'));
    	// return $pdf->stream('laporan-ketersediaan-buku.pdf');

        $pdf = Pdf::loadView('pdfs.laporanusers', compact('user'));

        // Stream untuk menampilkan tampilan PDF pada browser
        return $pdf->stream('table_users.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard/detailuser', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Temukan data buku berdasarkan ID
        $user = User::find($id);
    
        // Cek apakah ada file baru diunggah
        if ($request->hasFile('imguser')) {
            // Hapus gambar lama jika ada
            Storage::disk('public')->delete($user->imguser);
    
            // Proses file gambar baru
            $fileName = $request->file('imguser')->getClientOriginalName();
            $path = $request->file('imguser')->storeAs('user/photos', $fileName, 'public');
            $user->ImgBuku = 'storage/' . $path;
        }
    
        // Update data tanpa mengubah gambar
        $user->update($request->except('imguser'));
    
        // Redirect ke halaman buku setelah update
        return redirect()->route('users.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        

        // Redirect ke halaman buku setelah update
        return redirect()->route('users.index');
    }
}

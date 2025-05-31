<?php

namespace App\Http\Controllers;

use App\Services\FireBaseService;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProfileController
{
    protected $firebase;
    // Constructor tempat dependency injection terjadi
    public function __construct(FireBaseService $firebase)
    {
        $this->firebase = $firebase; // Di sini $firebaseService seharusnya di-assign
    }

    public function login()
    {
        return view('profiles.login', [
            "namepage" => "Login",
        ]);
    }
    
    public function masuk(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $auth = $this->firebase->getAuth(); // Ambil instance Auth dari service
            $signInResult = $auth->signInWithEmailAndPassword($request->email, $request->password);

            $user = $signInResult->data();

            // Simpan informasi user atau token di session
            Session::put('firebase_user_id', $user['localId']); // localId adalah UID pengguna di Firebase
            Session::put('id_token', $signInResult->idToken()); // Simpan ID Token jika diperlukan untuk request ke Firebase API nantinya

            return redirect()->intended('/')->with('success', 'Login berhasil!');


        } catch (UserNotFound $e) {
            return back()->withErrors(['userfail' => 'User tidak ditemukan atau email salah.'])->withInput($request->only('email'));
        } catch (\Throwable $e) {
            Log::error('Login Gagal: Kesalahan Umum - ' . $request->email . ' | Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mencoba login. Silakan coba lagi nanti.'])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        try {
            $firebaseUserId = Session::get('firebase_user_id'); // Ambil UID jika Anda ingin log atau revoke

            // OPSI OPSIONAL: Revoke refresh token jika diperlukan (pastikan $firebaseUserId valid)
            if ($firebaseUserId && $this->firebase && $this->firebase->getAuth()) {
                try {
                    $this->firebase->getAuth()->revokeRefreshTokens($firebaseUserId);
                    Log::info('Refresh token berhasil direvoke untuk user: ' . $firebaseUserId);
                } catch (\Throwable $revokeException) {
                    Log::error('Gagal merevoke refresh token untuk user ' . $firebaseUserId . ': ' . $revokeException->getMessage());
                    // Lanjutkan logout sesi lokal meskipun revoke gagal
                }
            }

            Session::forget('firebase_user_id');
            Session::forget('firebase_user_data');
            Session::forget('id_token');

            Session::regenerate(true);

            return redirect('/login')->with('success', 'Anda berhasil logout.');

        } catch (\Throwable $e) {
            Log::error('Logout Gagal (Blok Catch Utama): ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect(url('/'))->withErrors(['error' => 'Terjadi kesalahan saat logout. Silakan coba lagi.']);
        }
    }
}

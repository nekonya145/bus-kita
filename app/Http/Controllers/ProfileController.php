<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FireBaseService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Auth\InvalidPassword;

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
            $firebaseUserId = Session::get('firebase_user_id');

            // Opsional: Revoke refresh tokens
            if ($firebaseUserId) {
                $auth = $this->firebase->getAuth();
                if ($auth) {
                    try {
                        $auth->revokeRefreshTokens($firebaseUserId);
                    } catch (\Throwable $e) {
                        Log::error('Logout: Error umum saat merevoke token untuk UID ' . $firebaseUserId . ': ' . $e->getMessage());
                    }
                } else {
                    Log::warning('Layanan Firebase Auth tidak tersedia saat mencoba merevoke token.');
                }
            }

            Session::forget('firebase_user_id');
            Session::forget('firebase_user_data');
            Session::forget('id_token');

            Session::invalidate();
            Log::info('Sesi Laravel telah diinvalidasi. UID yang sebelumnya terkait: ' . ($firebaseUserId ?? 'Tidak ada'));

            return redirect('/login')->with('success', 'Anda berhasil logout.');

        } catch (\Throwable $e) {
            Log::error('Logout Gagal (Blok Catch Utama): ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect(url('/'))->withErrors(['error' => 'Terjadi kesalahan saat logout. Silakan coba lagi.']);
        }
    }
}

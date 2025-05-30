<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\Auth\InvalidPassword;

class ProfileController
{
    protected $firebase;
    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function login()
    {
        return view('profiles.login', [
            "namepage" => "Login",
        ]);
    }
    public function masuk(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $auth = $this->firebase->getAuth();

        try {
            $signIn = $auth->signInWithEmailAndPassword($credentials['email'], $credentials['password']);
            $idToken = $signIn->idToken();
            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            $user = $auth->getUser($uid);
            // $customClaims = $user->customClaims;
            $role = $customClaims['role'] ?? 'unknown';
            
            if ($role !== 'admin') {
                return redirect('/login')->withErrors(['email' => 'Akses hanya diperbolehkan untuk admin.']);
            }
            // Simpan ke session
            Session::put('firebase_user', $user);
            Session::put('role', $role);

            return redirect()->intended('/')->with('userinmessage', 'Login berhasil melalui Firebase');
        } catch (InvalidPassword $e) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        } catch (\Throwable $e) {
            return back()->withErrors(['email' => 'Login gagal: ' . $e->getMessage()]);
        }
    }
    // public function register(Request $request)
    // {
    //     $auth = $this->firebase->getAuth();
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $email = $credentials['email'];
    //     $password = $credentials['password'];
        
    //     try{
    //         $createdUser = $this->$auth->createUserWithEmailAndPassword($email, $password);
    //         Session::flash('success', 'Registrasi Berhasil');
    //     } catch(\Exception $e){
    //         Session::flash('success', 'Registrasi Berhasil');
    //     }
    // }
}

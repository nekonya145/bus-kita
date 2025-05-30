<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Database;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected $factory;
    protected $auth;
    protected $database;

    public function __construct()
    {
        try {
            $factory = (new Factory)
                ->withServiceAccount(storage_path(env('FIREBASE_CREDENTIALS', 'app/firebase_credentials.json'))) // Pastikan path ini benar dan file ada
                ->withDatabaseUri(env('FIREBASE_DATABASE_URL')); // Pastikan URL database benar jika menggunakan Realtime Database

            $this->auth = $factory->createAuth();
            $this->database = $factory->createDatabase();

        } catch (\Throwable $e) {
            // Log error jika inisialisasi Firebase gagal
            Log::critical('Gagal menginisialisasi Firebase SDK: ' . $e->getMessage());
            $this->auth = null; // Set ke null agar method getAuth() bisa diperiksa
            $this->database = null;
        }
    }
    /**
     * Mengembalikan instance Firebase Auth.
     *
     * @return FirebaseAuth|null
     */

    public function getAuth(): ?FirebaseAuth
    {
        return $this->auth;
    }

    /**
     * Mengembalikan instance Firebase Realtime Database.
     *
     * @return Database|null
     */
    public function getDatabase(): ?Database
    {
        return $this->database;
    }

}

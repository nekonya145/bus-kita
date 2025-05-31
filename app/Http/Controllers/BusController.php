<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\FireBaseService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class BusController
{
    protected $firebase;
    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function manajemen_bus()
    {
        $busses = $this->firebase->getDatabase()->getReference('busses')->getValue();
        $routes = $this->firebase->getDatabase()->getReference('routes')->getValue();
        $drivers = $this->firebase->getDatabase()->getReference('drivers')->getValue();

        return view('dashboards.manajemen-bus', [
            "namepage" => "Manajemen Bus",
            "busses"   => $busses,
            "routes"   => $routes,
            "drivers"  => $drivers,
        ]);
    }
    
    public function manajemen_rute()
    {
        $routes = $this->firebase->getDatabase()->getReference('routes')->getValue();
        return view('dashboards.manajemen-jadwal', [
            "namepage" => "Manajemen Jadwal",
            "routes"   => $routes,
        ]);
    }

    public function tambah_rute(Request $request)
    {
        $validatedData = $request->validate([
            'nama_rute' => 'required|string|max:8',
            'jalur_rute' => 'required|string|max:50',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'jam_kepulangan' => 'required|date_format:H:i',
            'hari_keberangkatan' => ['required', 'string', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])],
        ]);

        try {
            $database = $this->firebase->getDatabase();
            $newJadwalRef = $database->getReference('routes')->push(); // push() akan menghasilkan ID unik

            $jadwalData = [
                'id_bus' => $validatedData['id_bus'],
                'rute_asal' => $validatedData['rute_asal'],
                'rute_tujuan' => $validatedData['rute_tujuan'],
                'hari_keberangkatan' => $validatedData['hari_keberangkatan'],
                'jam_keberangkatan' => $validatedData['jam_keberangkatan'],
                'harga_tiket' => (float) $validatedData['harga_tiket'], // Simpan sebagai float/number
                'dibuat_pada' => now()->toIso8601String(), // Tambahkan timestamp jika perlu
            ];

            $newJadwalRef->set($jadwalData); // Simpan data ke Firebase

            Log::info('Jadwal bus baru berhasil disimpan ke Firebase dengan ID: ' . $newJadwalRef->getKey());

            return redirect()->route('/rute-bus')->with('success', 'Jadwal bus baru berhasil ditambahkan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validasi sudah ditangani oleh $request->validate(), ini untuk jaga-jaga jika ada validasi manual
            Log::warning('Validasi gagal saat menyimpan jadwal: ', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Terjadi kesalahan saat menyimpan jadwal bus ke Firebase: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}

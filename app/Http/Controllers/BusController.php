<?php

namespace App\Http\Controllers;

class BusController
{
    public function manajemen_bus()
    {
        return view('dashboards.manajemen-bus', [
            "namepage" => "Manajemen Bus",
            "busses"   => [
                            [
                                'plat' => 'DD 2312 CD',
                                'rute' => 'Rute A',
                                'deskripsi' => 'Pettarani - Paropo',
                                'status' => 'OFFLINE',
                                'akses' => 'BISA DIAKSES',
                            ],
                            [
                                'plat' => 'DD 1234 AB',
                                'rute' => 'Rute B',
                                'deskripsi' => 'Paropo - Batua',
                                'status' => 'AKTIF',
                                'akses' => 'TIDAK BISA DIAKSES',
                            ],
                            [
                                'plat' => 'DD 1234 AB',
                                'rute' => 'Rute B',
                                'deskripsi' => 'Paropo - Batua',
                                'status' => 'AKTIF',
                                'akses' => 'TIDAK BISA DIAKSES',
                            ],
                          ],
        ]);
    }
    public function manajemen_jadwal()
    {
        return view('dashboards.manajemen-jadwal', [
            "namepage" => "Manajemen Jadwal",
            "routes"   => [
                            [
                                'nama' => 'RUTE A',
                                'rute' => 'Pettarani - Palopo',
                                'hari' => 'Senin',
                                'time-start' => '06.00',
                                'time-end' => '15.30',
                                'aksebilitas' => 'TERSEDIA',
                            ],
                            [
                                'nama' => 'RUTE B',
                                'rute' => 'Palopo - Batua',
                                'hari' => 'Selasa',
                                'time-start' => '06.00',
                                'time-end' => '15.30',
                                'aksebilitas' => 'TIDAK TERSEDIA',
                            ],
                            [
                                'nama' => 'RUTE C',
                                'rute' => 'Amel - Batua',
                                'hari' => 'Selasa',
                                'time-start' => '06.00',
                                'time-end' => '15.30',
                                'aksebilitas' => 'TERSEDIA',
                            ],
                          ],
        ]);
    }
}

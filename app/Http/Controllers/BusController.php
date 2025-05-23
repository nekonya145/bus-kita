<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;

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

        return view('dashboards.manajemen-bus', [
            "namepage" => "Manajemen Bus",
            "busses"   => $busses,
        ]);
    }
    
    public function manajemen_jadwal()
    {
        $routes = $this->firebase->getDatabase()->getReference('routes')->getValue();
        return view('dashboards.manajemen-jadwal', [
            "namepage" => "Manajemen Jadwal",
            "routes"   => $routes,
        ]);
    }
}

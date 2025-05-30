<?php

namespace App\Http\Controllers;
use App\Services\FireBaseService;

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
    
    public function manajemen_jadwal()
    {
        $routes = $this->firebase->getDatabase()->getReference('routes')->getValue();
        return view('dashboards.manajemen-jadwal', [
            "namepage" => "Manajemen Jadwal",
            "routes"   => $routes,
        ]);
    }
}

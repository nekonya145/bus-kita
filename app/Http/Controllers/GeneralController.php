<?php

namespace App\Http\Controllers;
use App\Services\FirebaseService;

class GeneralController
{
    protected $firebase;
    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $busses = $this->firebase->getDatabase()->getReference('busses')->getValue();
        $routes = $this->firebase->getDatabase()->getReference('routes')->getValue();
        $siswas = $this->firebase->getDatabase()->getReference('siswas')->getValue();
        return view('dashboards.index', [
            "namepage" => "Dashboard",
            "busses" => $busses,
            "routes" => $routes,
            "siswas" => $siswas,
        ]);
    }
    
    public function live_monitoring()
    {
        $busses = $this->firebase->getDatabase()->getReference('busses')->getValue();
        $routes = $this->firebase->getDatabase()->getReference('routes')->getValue();
        return view('dashboards.live-monitoring', [
            "namepage" => "Live Monitoring",
            "busses" => $busses,
            "routes" => $routes,
        ]);
    }
}
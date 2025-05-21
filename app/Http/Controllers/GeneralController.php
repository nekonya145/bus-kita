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
        return view('dashboards.index', [
            "namepage" => "Dashboard",
            "busses" => $busses,
        ]);
    }
    
    public function live_monitoring()
    {
        $busses = $this->firebase->getDatabase()->getReference('busses')->getValue();
        return view('dashboards.live-monitoring', [
            "namepage" => "Live Monitoring",
            "busses" => $busses,
        ]);
    }
}
<?php

namespace App\Http\Controllers;

class GeneralController
{
    public function index()
    {
        return view('dashboards.index', [
            "namepage" => "Dashboard",
        ]);
    }
    public function live_monitoring()
    {
        return view('dashboards.live-monitoring', [
            "namepage" => "Live Monitoring",
        ]);
    }
}
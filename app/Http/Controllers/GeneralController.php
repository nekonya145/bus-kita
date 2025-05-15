<?php

namespace App\Http\Controllers;

class GeneralController extends Controller
{
    public function index()
    {
        return view('dashboards.index', [
            "namepage" => "Dashboard",
        ]);
    }
    public function manajemen_bus()
    {
        return view('dashboards.manajemen-bus', [
            "namepage" => "Manajemen Bus",
        ]);
    }
    public function manajemen_jadwal()
    {
        return view('dashboards.manajemen-jadwal', [
            "namepage" => "Manajemen Jadwal",
        ]);
    }
    public function live_monitoring()
    {
        return view('dashboards.live-monitoring', [
            "namepage" => "Live Monitoring",
        ]);
    }
}

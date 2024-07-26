<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this line to import the DB facade

class HomeController extends Controller
{
    public function index(): View
    {
        return view('backend.home.main');
    }

    public function entry()
    {
        $regionals = DB::table('referensi')->distinct()->pluck('regional');
        return view('backend.home.entry', compact('regionals'));
    }

    public function update()
    {
        return view('backend.home.update');
    }

    public function monitoring()
    {
        return view('backend.home.monitoring');
    }
}

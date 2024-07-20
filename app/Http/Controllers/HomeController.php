<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('backend.home.main');
    }

    public function entry()
    {
        return view('backend.home.entry');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function index()
    {
        return view('tps.tps'); // Pastikan 'tps.blade.php' ada di folder resources/views
    }
}

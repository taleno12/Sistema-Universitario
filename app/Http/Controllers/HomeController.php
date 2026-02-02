<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Carrera;
use App\Models\Facultade;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'cant_estudiantes' => Estudiante::count(),
            'cant_carreras'    => Carrera::count(),
            'cant_facultades'  => Facultade::count(),
        ]);
    }
}
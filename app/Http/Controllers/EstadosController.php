<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index()
{
    $estados = Estados::all();
    return view('estados.index', compact('estados'));
}

}

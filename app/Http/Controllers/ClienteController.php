<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estados;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        
        $clientes = Cliente::paginate(4);
        $estados = Estados::all();
        return view('clientes.index', compact('clientes','estados'));
    }

    public function create()
    {
        $estados = Estados::all();
        return view('clientes.create', compact('estados'));
    }

    public function store(Request $request)
    {
      
        $estado_id = $request->input('estado_id');
        $estado = Estados::find($estado_id);

        
        $cliente = new Cliente();
        $cliente->cliente = $request->input('cliente');
        $cliente->cpf = $request->input('cpf');
        $cliente->data_nascimento = $request->input('data_nascimento');
        $cliente->endereco = $request->input('endereco');
        $cliente->estado()->associate($estado);
        $cliente->cidade = $request->input('cidade');
        $cliente->sexo = $request->input('sexo');
        $cliente->save();


        return redirect()->route('clientes.index');
    }


    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.show', ['cliente' => $cliente]);
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->cliente = $request->input('cliente');
        $cliente->cpf = $request->input('cpf');
        $cliente->data_nascimento = $request->input('data_nascimento');
        $cliente->estado = $request->input('estado');
        $cliente->cidade = $request->input('cidade');
        $cliente->sexo = $request->input('sexo');
        $cliente->save();

        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }

    public function search(Request $request)
    {
        $clientes = Cliente::query();

        if ($request->filled('cpf')) {
            $clientes->where('cpf', 'like', '%' . $request->cpf . '%');
        }

        if ($request->filled('cliente')) {
            dd($request->cliente);
            $clientes->where('cliente', 'like', '%' . $request->cliente . '%');
        }

        if ($request->filled('data_nascimento')) {
            $clientes->where('data_nascimento', $request->data_nascimento);
        }

        if ($request->filled('sexo')) {
            $clientes->where('sexo', $request->sexo);
        }
        
        if ($request->filled('estado_id')) {
            // dd($request->estado_id);
            $estados = Estados::where('id', 'like', '%' . $request->estado_id . '%')->get();
            // dd($estados, $request->estado_id);
            $clientes->whereIn('estado_id', $estados->pluck('id'));
        }

        if ($request->filled('cidade')) {
            $clientes->where('cidade', 'like', '%' . $request->cidade . '%');
        }

        $clientes = $clientes->paginate(10);
        $estados = Estados::orderBy('name')->get();

        return view('clientes.index', compact('clientes', 'estados'));
    }


}

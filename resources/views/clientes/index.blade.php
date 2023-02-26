@extends('layouts.app')

@section('content')
<form class="mt-4 border border-dark rounded"  method="POST" action="{{ route('clientes.store') }}">
    @csrf
    <div class="form-content  border border-dark rounded">

    <div class="row-1 d-flex justify-content-between">
    <div class="form-group">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control" name="cpf" id="cpf">
    </div>

    <div class="form-group">
        <label for="cliente">Cliente</label>
        <input type="text" class="form-control" name="cliente" id="cliente">
    </div>
    <div class="form-group">
        <label for="data_nascimento">Data de Nascimento</label>
        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
    </div>
    <div class="form-group">
        <label for="sexo">Sexo</label>
        <select name="sexo" id="sexo" class="form-control">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
    </div>
    </div>
    <div class="row-2 d-flex justify-content-between">
    <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" id="endereco">
        </div>

        <div class="form-group">
            <label for="estado_id">Estado</label>
            @component('components.dropdown', [
                'name' => 'estado_id',
                'options' => $estados
            ])
            @endcomponent
        </div>

        
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" name="cidade" id="cidade">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
    </div>
</form>

<form class="border border-dark rounded" action="{{ route('clientes.search') }}" method="GET">
    <div class="form-content-2  border border-dark rounded" >

    
    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" class="form-control">
    </div>
    <div class="form-group">
        <label for="cliente">cliente:</label>
        <input type="text" name="cliente" id="cliente" class="form-control">
    </div>
    <div class="form-group">
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control">
    </div>
    <div class="form-group">
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" class="form-control">
            <option value="">Selecione</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
    </div>
    <div class="form-group">
            <label for="estado_id">Estado</label>
            @component('components.dropdown', [
                'name' => 'estado_id',
                'options' => $estados
            ])
            @endcomponent
        </div>
    <div class="form-group">
        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

<table class="table mt-4 table-dark">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Cliente</th>
            <th>CPF</th>
            <th>Data de nascimento</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Sexo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)

       
            <tr>
                <td>
                 
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-primary">Editar</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('clientes.destroy', $cliente->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
                <td>{{ $cliente->cliente }}</td>
                <td>{{ $cliente->CPF }}</td>
                <td>{{ $cliente->data_nascimento }}</td>
                <td>{{ $cliente->estado->name }}</td>
                <td>{{ $cliente->cidade }}</td>
                <td>{{ $cliente->sexo }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-4">
    <ul class="pagination">
        @if ($clientes->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $clientes->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
        @endif
        @foreach ($clientes->getUrlRange(1, $clientes->lastPage()) as $page => $url)
            @if ($page == $clientes->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endif
        @endforeach
        @if ($clientes->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $clientes->nextPageUrl() }}" rel="next">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">&raquo;</span>
            </li>
        @endif
    </ul>
</div>

@endsection
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'cliente', 'cpf', 'data_nascimento', 'endereco', 'estado_id', 'cidade', 'sexo'
    ];
    use HasFactory;
    public function estado()
{
    return $this->belongsTo(Estados::class);
}

}

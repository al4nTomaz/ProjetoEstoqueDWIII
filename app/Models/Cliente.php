<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'cep',
         'cidade',
         'uf',
         'rua',
        'numero',
        'bairro',
        'complemento'
    ];

    public function saidas()
    {
        return $this->hasMany(SaidaProduto::class);
    }

}

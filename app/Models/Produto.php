<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome', 
        'imagem', 
        'estoque', 
        'descricao', 
        'valor_unitario',
        'id_unidade',
        'id_categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'id_categoria');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class,'id_unidade');
    }
    // No modelo Produto
    public function saidas()
    {
        return $this->hasMany(SaidaProduto::class);
    }

}

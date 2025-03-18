<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $fillable = ['cliente_id', 'produto_id', 'quantidade', 'valor_total', 'data_saida'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id'); // Certifique-se de que a chave estrangeira é 'produto_id'
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id'); // Caso haja o relacionamento com o Cliente
    }

}


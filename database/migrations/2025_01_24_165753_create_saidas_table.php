<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com a tabela de clientes
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade'); // Exclui as saídas se o cliente for deletado

            // Relacionamento com a tabela de produtos
            $table->foreignId('produto_id')
                  ->constrained('produtos')
                  ->onDelete('cascade'); // Exclui as saídas se o produto for deletado

            $table->integer('quantidade')->unsigned(); // Garante que não haverá valores negativos
            $table->decimal('valor_total', 10, 2);
            $table->timestamp('data_saida')->useCurrent(); // Define a data atual como padrão
            $table->string('qrcode_path')->nullable(); // Armazenamento opcional do caminho do QR Code

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saidas');
    }
};

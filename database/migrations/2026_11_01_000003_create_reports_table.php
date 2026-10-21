<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo')->unique();
            $table->string('tipo');
            $table->text('descricao');
            $table->string('endereco');
            $table->string('bairro')->nullable();
            $table->string('nome')->nullable();
            $table->string('contato')->nullable();
            $table->string('status')->default('nova');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

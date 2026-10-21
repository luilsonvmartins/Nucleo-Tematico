<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('especie')->default('cachorro');
            $table->string('sexo')->default('macho');
            $table->string('porte')->default('medio');
            $table->string('idade')->nullable();
            $table->text('descricao')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('disponivel');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};

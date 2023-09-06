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
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
           /*  $table->string('Matricule');
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('specialite');
            $table->foreignId('service_id')->constrained();
            $table->float('Tarif');
            $table->string('Tel');
            $table->string('Email');
            $table->foreignId('employe_id')->constrained();
            $table->timestamps(); */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};

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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('Matricule')->nullable();
            $table->foreignId('role_id')->constrained();
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('specialite')->nullable();
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float('Tarif')->nullable();
            $table->string('Tel')->unique()->nullable();
            $table->string('Email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};

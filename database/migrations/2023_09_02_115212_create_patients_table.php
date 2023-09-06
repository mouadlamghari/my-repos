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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('CIN')->unique();
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('Adresse');
            $table->string('Tel')->unique();
            $table->string('Email')->unique();
            $table->string('cinrecto')->nullable();
            $table->string('cinverso')->nullable();
            $table->foreignId('employe_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

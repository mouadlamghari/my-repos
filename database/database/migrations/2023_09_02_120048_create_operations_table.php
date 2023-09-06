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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('equipe_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('blocoperatoire');
            $table->dateTime('DateDebut');
            $table->dateTime('DateFin');
            $table->string('Observation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};

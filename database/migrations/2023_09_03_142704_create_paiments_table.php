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
        Schema::create('paiments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onUpdate('cascade');
            $table->foreignId('typepaiment_id')->constrained()->onUpdate('cascade');
            $table->string('numerocheck')->nullable();
            $table->date('date_demission')->nullable();
            $table->enum('status',['Confirme','En Attent','Rejected']);
            $table->date('date_depot')->nullable();
            $table->string('transaction')->nullable();
            $table->float('Montant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiments');
    }
};

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
        Schema::create('inscriptions', function (Blueprint $table) {

            $table->id();

            // relations
            $table->unsignedBigInteger('etudiant_id');
            $table->unsignedBigInteger('formation_id');

            $table->dateTime('date_inscription');

            // clés étrangères
            $table->foreign('etudiant_id')
                  ->references('id')
                  ->on('etudiants')
                  ->onDelete('cascade');

            $table->foreign('formation_id')
                  ->references('id')
                  ->on('formations')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
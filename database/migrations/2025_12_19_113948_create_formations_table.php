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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
             $table->string('titre');
            $table->text('description');
            $table->text('objectif')->nullable();
            $table->string('session')->nullable();
            $table->text('prerequis')->nullable();
            $table->string('duree')->nullable();

            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->string('lieu')->nullable();
            $table->string('photo')->nullable();
            $table->string('video')->nullable();

            $table->foreignId('formateur_id')
                  ->constrained('formateurs')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
}; 
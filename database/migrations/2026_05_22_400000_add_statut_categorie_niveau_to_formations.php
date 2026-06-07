<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->string('statut')->default('brouillon')->after('formateur_id');
            $table->string('categorie')->nullable()->after('titre');
            $table->string('niveau')->nullable()->after('categorie');
        });
    }

    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->dropColumn(['statut', 'categorie', 'niveau']);
        });
    }
};

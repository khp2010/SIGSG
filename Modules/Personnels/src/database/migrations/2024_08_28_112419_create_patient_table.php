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
            $table->increments("id");
            $table->string("telephone", 15)->nullable();
            $table->string("mail", 100)->nullable();
            $table->string("nationalite_etrangere", 100)->nullable();
            $table->string("filtre_confidentialite", 100)->nullable();
            $table->string("type_confidentialite", 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};

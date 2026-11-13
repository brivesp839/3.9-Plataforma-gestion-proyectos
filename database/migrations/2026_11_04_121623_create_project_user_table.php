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
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();  // qué proyecto
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();     // qué usuario
            $table->string('role')->default('member');                          // atributo de la relación
            $table->decimal('contribution_hours', 8, 2)->default(0);            // atributo de la relación
            $table->timestamps();

            $table->unique(['project_id', 'user_id']);  // evita repetir al mismo usuario en un proyecto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};

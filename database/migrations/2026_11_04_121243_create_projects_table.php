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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();                                   // id INT, clave primaria
            $table->foreignId('user_id')                    // user_id: quién crea el proyecto
                ->constrained()                             // lo enlaza con users.id
                ->cascadeOnDelete();                        // si se borra el usuario, se borran sus proyectos
            $table->string('title');                        // title VARCHAR
            $table->text('description')->nullable();        // description TEXT (opcional)
            $table->date('due_date')->nullable();           // due_date DATE (opcional)
            $table->string('status')->default('pending');   // status VARCHAR, por defecto "pending"
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

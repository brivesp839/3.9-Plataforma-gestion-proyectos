<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    //
    use HasFactory;

    // Columnas que se pueden rellenar con create() o update()
    protected $fillable = ['user_id', 'title', 'description', 'due_date', 'status'];

    // Convierte due_date en un objeto de fecha al leerlo
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    // Relación "Crea" (1:N): un proyecto pertenece a un usuario, su creador
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación "Participa" (N:N): un proyecto tiene muchos participantes
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'contribution_hours')
            ->withTimestamps();
    }
}

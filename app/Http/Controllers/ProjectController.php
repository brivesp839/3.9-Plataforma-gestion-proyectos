<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*
    public function index()
    {
        //
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }
    */
    public function index()
    {
        $projects = Project::with('creator')
            ->withCount('users')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    //Muestra el formulario para dar de alta un proyecto nuevo
    public function create()
    {
        //Array con los estados posibles
        $statuses = [
            'pending' => 'Pendiente',
            'in_progress' => 'En curso',
            'completed' => 'Completado',
        ];

        return view('projects.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    //La ruta que recibe la información que se ha puesto en el formulario de create
    public function store(Request $request)
    {
        //Valido todos los campos del formulario y devuelvo array con campos si es correcto
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date'    => ['nullable', 'date'],
            'status'      => ['required', 'in:pending,in_progress,completed'],
        ]);

        //Añado al usuario o creador al array que no se encuentra en el formulario
        $validated['user_id'] = $request->user()->id;

        //Inserto en /projects la fila de los datos creados
        Project::create($validated);

        //Redirigo al listado en vez de crear vista para evitar duplicación del proyecto
        return redirect()
            ->route('projects.index')
            ->with('status', 'Proyecto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    //Muestra un único proyecto
    public function show(Project $project) //Llama al modelo de project y entrega el proyecto
    {
        //Load trae 1 vez el creador y los participantes
        $project->load(['creator', 'users']);
        //Paso todos los usuarios a la vista
        $users = User::orderBy('name')->get();

        return view('projects.show', compact('project', 'users')); //Llama a la lista y le pasa los datos
    }

    /**
     * Show the form for editing the specified resource.
     */

    //Muestra un formulario de edición con los datos actuales del proyecto ya rellenados
    public function edit(Project $project) //Recibo el proyecto por el modelo 
    {
        //Paso la lista de estados para el desplegable
        //Array con los estados posibles
        $statuses = [
            'pending' => 'Pendiente',
            'in_progress' => 'En curso',
            'completed' => 'Completado',
        ];

        return view('projects.edit', compact('project', 'statuses')); //Llamo a la lista y le paso los estados
    }

    /**
     * Update the specified resource in storage.
     */
    //Actualiza el proyecto con los nuevos datos que se han puesto en el edit
    public function update(Request $request, Project $project)
    {
        //Valido todos los campos del formulario y devuelvo array con campos si es correcto
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date'    => ['nullable', 'date'],
            'status'      => ['required', 'in:pending,in_progress,completed'],
        ]);

        //Actualizo el proyecto
        $project->update($validated);

        //Redirigo al listado en vez de crear vista para evitar duplicación del proyecto
        return redirect()
            ->route('projects.index')
            ->with('status', 'Datos del proyecto actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project) //Llama al modelo de project y entrega el proyecto
    {
        //Borro el proyecto con Eloquent
        $project->delete();

        //Redirigo al listado
        return redirect()
            ->route('projects.index')
            ->with('status', 'Datos del proyecto actualizados correctamente.');
    }

    //Asigno los usuarios al proyecto
    public function syncUsers(Request $request, Project $project)
    {
        $validated = $request->validate([
            'users'   => ['nullable', 'array'],
            'users.*' => ['exists:users,id'], //Valida cada elemento del array: que el id exista en users
        ]);

        $project->users()->sync($validated['users'] ?? []); // ?? [] cubre el caso de no marcar ninguna casilla

        return back()->with('status', 'Participantes actualizados.'); //Devuelve a la página anterior
    }
}

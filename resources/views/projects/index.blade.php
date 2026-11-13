<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyectos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <!--Modificación para ruta create -->
                    <div class="mb-4">
                        <a href="{{ route('projects.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase rounded-md hover:bg-gray-700">
                            Nuevo proyecto
                        </a>
                    </div>
                    <!--Modificación para ruta store-->
                    @if (session('status'))
                    <div class="mb-4 p-3 rounded-md bg-green-100 text-green-800 text-sm">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!---->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="text-left text-sm font-semibold text-gray-600">
                                <th class="px-4 py-3">Título</th>
                                <th class="px-4 py-3">Creador</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Fecha límite</th>
                                <th class="px-4 py-3">Participantes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse ($projects as $project)
                            <tr>
                                <!---------------------Modifico el título------------------------------>
                                <!--<td class="px-4 py-3 font-medium">{{ $project->title }}</td>-->
                                <td class="px-4 py-3 font-medium">
                                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:underline">
                                        {{ $project->title }}
                                    </a>
                                </td>
                                <!---------------------Modifico el título------------------------------>
                                <td class="px-4 py-3">{{ $project->creator->name }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full {{ match ($project->status) {
                                            'completed' => 'bg-green-100 text-green-800',
                                            'in_progress' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        } }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $project->due_date?->format('d/m/Y') ?? 'Sin fecha' }}
                                </td>
                                <td class="px-4 py-3">{{ $project->users_count }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    Todavía no hay proyectos.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
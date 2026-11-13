<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Datos del proyecto --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="font-semibold text-gray-600">Creador</dt>
                            <dd>{{ $project->creator->name }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Estado</dt>
                            <dd>
                                <span class="px-2 py-1 text-xs rounded-full {{ match ($project->status) {
                                    'completed' => 'bg-green-100 text-green-800',
                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-gray-100 text-gray-800',
                                } }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Fecha límite</dt>
                            <dd>{{ $project->due_date?->format('d/m/Y') ?? 'Sin fecha' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Creado el</dt>
                            <dd>{{ $project->created_at->format('d/m/Y') }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="font-semibold text-gray-600">Descripción</dt>
                            <dd>{{ $project->description ?? 'Sin descripción' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Participantes --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <h3 class="font-semibold text-lg mb-4">Participantes</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="text-left text-sm font-semibold text-gray-600">
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Rol</th>
                                <th class="px-4 py-3">Horas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse ($project->users as $user)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ ucfirst($user->pivot->role) }}</td>
                                <td class="px-4 py-3">{{ number_format($user->pivot->contribution_hours, 1, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    Este proyecto aún no tiene participantes.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if ($project->users->isNotEmpty())
                        <tfoot>
                            <tr class="text-sm font-semibold">
                                <td colspan="3" class="px-4 py-3 text-right">Total de horas</td>
                                <td class="px-4 py-3">
                                    {{ number_format($project->users->sum('pivot.contribution_hours'), 1, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            <div>
                <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    &larr; Volver al listado
                </a>
                <!--Botón para redirigir a edit -->
                <a href="{{ route('projects.edit', $project) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase rounded-md hover:bg-gray-700">
                    Editar
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
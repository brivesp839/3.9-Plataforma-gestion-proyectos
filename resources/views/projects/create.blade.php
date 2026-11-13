<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo proyecto') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
 
                    <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                        @csrf
 
                        <div>
                            <x-input-label for="title" value="Título" />
                            <x-text-input id="title" name="title" type="text"
                                class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
 
                        <div>
                            <x-input-label for="description" value="Descripción" />
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
 
                        <div>
                            <x-input-label for="due_date" value="Fecha límite" />
                            <x-text-input id="due_date" name="due_date" type="date"
                                class="mt-1 block w-full" :value="old('due_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                        </div>
 
                        <div>
                            <x-input-label for="status" value="Estado" />
                            <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', 'pending') === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
 
                        <div class="flex items-center gap-4">
                            <x-primary-button>Guardar proyecto</x-primary-button>
                            <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                        </div>
                    </form>
 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
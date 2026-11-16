<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} | Gestión de proyectos</title>

        <!-- Fuentes (las mismas que usa Breeze) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-white">

        {{-- ============ 1. BARRA DE NAVEGACIÓN ============ --}}
        <header class="border-b border-gray-100">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <a href="/" class="text-lg font-bold text-indigo-600">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('projects.index') }}"
                           class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                            Ir a mis proyectos
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-gray-900">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <main>

            {{-- ============ 2. HERO ============ --}}
            <section class="bg-gray-50">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
                    <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
                        Organiza tus proyectos y a tu equipo en un solo lugar
                    </h1>
                    <p class="mt-6 text-lg text-gray-600">
                        Crea proyectos, asigna participantes y sigue el estado de cada uno
                        sin hojas de cálculo ni mensajes sueltos.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('register') }}"
                           class="w-full sm:w-auto px-6 py-3 text-base font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500">
                            Crear cuenta gratis
                        </a>
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto px-6 py-3 text-base font-semibold text-gray-700 bg-white rounded-md ring-1 ring-gray-300 hover:bg-gray-50">
                            Ya tengo cuenta
                        </a>
                    </div>
                </div>
            </section>

            {{-- ============ 3. CARACTERÍSTICAS ============ --}}
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center max-w-2xl mx-auto">
                    <h2 class="text-3xl font-bold tracking-tight">Todo lo que necesitas</h2>
                    <p class="mt-4 text-gray-600">Una herramienta sencilla para gestionar el trabajo en equipo.</p>
                </div>

                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 bg-white rounded-xl shadow-sm ring-1 ring-gray-200">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold">1</div>
                        <h3 class="mt-4 text-lg font-semibold">Crea proyectos</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Define un título, una descripción y una fecha límite para cada proyecto.
                        </p>
                    </div>

                    <div class="p-6 bg-white rounded-xl shadow-sm ring-1 ring-gray-200">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold">2</div>
                        <h3 class="mt-4 text-lg font-semibold">Asigna participantes</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Elige quién forma parte de cada proyecto, con su rol y sus horas de contribución.
                        </p>
                    </div>

                    <div class="p-6 bg-white rounded-xl shadow-sm ring-1 ring-gray-200">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold">3</div>
                        <h3 class="mt-4 text-lg font-semibold">Sigue el estado</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Consulta de un vistazo qué está pendiente, en curso o completado.
                        </p>
                    </div>
                </div>
            </section>

            {{-- ============ 4. LLAMADA A LA ACCIÓN FINAL ============ --}}
            <section class="bg-indigo-600">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-white">¿Listo para empezar?</h2>
                    <p class="mt-4 text-indigo-100">Regístrate en menos de un minuto.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block mt-8 px-6 py-3 text-base font-semibold text-indigo-600 bg-white rounded-md hover:bg-indigo-50">
                        Crear cuenta
                    </a>
                </div>
            </section>

        </main>

        {{-- ============ 5. PIE DE PÁGINA ============ --}}
        <footer class="border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
            </div>
        </footer>

    </body>
</html>
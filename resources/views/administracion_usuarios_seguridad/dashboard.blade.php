<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gestión Académica — Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 600:'#2563eb', 700:'#1d4ed8', 800:'#1e40af' },
                        sidebar: { bg:'#0f172a', hover:'#1e293b', border:'#0b1224' },
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50">
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-[18rem_1fr]">
    <!-- Sidebar -->
    <nav class="bg-sidebar-bg text-slate-200 border-r border-sidebar-border sticky top-0 h-screen hidden lg:flex flex-col">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-sidebar-border">
            <div class="h-9 w-9 rounded-full bg-primary-700 flex items-center justify-center shadow-md">
                <!-- Mortarboard icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-white"><path d="M11.7 2.04a1 1 0 0 1 .6 0l9 3a1 1 0 0 1 0 1.92l-3.2 1.07v3.02a2 2 0 0 1-1.2 1.84l-4 1.78a2 2 0 0 1-1.6 0l-4-1.78a2 2 0 0 1-1.2-1.84V8.03L1.7 6.96a1 1 0 0 1 0-1.92l9-3Z"/></svg>
            </div>
            <div>
                <div class="text-sm uppercase tracking-wide text-slate-400">Sistema</div>
                <div class="font-semibold text-slate-100">Gestión Académica</div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-2 py-3 space-y-2" id="sidebarModules">
            <!-- Administración de Usuarios y Seguridad -->
            <section x-data="{open:true}" data-module="seguridad" class="rounded-lg overflow-hidden ring-1 ring-white/5">
                <button @click="open=!open" :aria-expanded="open.toString()" class="w-full flex items-center justify-between px-3 py-2 text-left bg-white/5 hover:bg-white/10 transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M12 1.75a4.75 4.75 0 0 0-4.75 4.75v2.25H6A2.75 2.75 0 0 0 3.25 11.5v7.75A2.75 2.75 0 0 0 6 22h12a2.75 2.75 0 0 0 2.75-2.75V11.5A2.75 2.75 0 0 0 18 8.75h-1.25V6.5A4.75 4.75 0 0 0 12 1.75Z"/></svg>
                        <span class="font-medium">Administración de Usuarios y Seguridad</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="h-4 w-4 text-slate-300 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                </button>
                <ul x-show="open" x-collapse class="py-1" aria-label="Casos de uso — Seguridad">
                    <li><a href="#" data-role="CU1" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><span class="sr-only">CU1</span><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m12 0-4 4m4-4-4-4m6 8V8a2 2 0 0 0-2-2h-3"/></svg>Iniciar sesión</a></li>
                    <li><a href="#" data-role="CU2" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h12m0 0-4-4m4 4-4 4M15 20H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h9"/></svg>Cerrar sesión</a></li>
                    <li><a href="#" data-role="CU3" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 0 0 2-2V7l-7-4-7 4v12a2 2 0 0 0 2 2z"/></svg>Recuperar contraseña</a></li>
                    <li><a href="#" data-role="CU4" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 0 1 8 16h8a4 4 0 0 1 2.879 1.804M15 11a3 3 0 1 0-6 0 3 3 0 0 0 6 0Z"/></svg>Gestionar usuarios</a></li>
                    <li><a href="#" data-role="CU5" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h6"/></svg>Gestionar bitácora</a></li>
                </ul>
            </section>

            <!-- Gestión Académica -->
            <section x-data="{open:true}" data-module="academica" class="rounded-lg overflow-hidden ring-1 ring-white/5">
                <button @click="open=!open" :aria-expanded="open.toString()" class="w-full flex items-center justify-between px-3 py-2 text-left bg-white/5 hover:bg-white/10 transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5"><path d="M3 4.75A1.75 1.75 0 0 1 4.75 3h6.5A1.75 1.75 0 0 1 13 4.75v6.5A1.75 1.75 0 0 1 11.25 13h-6.5A1.75 1.75 0 0 1 3 11.25v-6.5Z"/><path d="M14.5 4.75A1.75 1.75 0 0 1 16.25 3h3A1.75 1.75 0 0 1 21 4.75v3A1.75 1.75 0 0 1 19.25 9h-3A1.75 1.75 0 0 1 14.5 7.25v-2.5Z"/><path d="M14.5 14.5A1.5 1.5 0 0 1 16 13h3a2 2 0 0 1 2 2v3.25A2.75 2.75 0 0 1 18.25 21H16a1.5 1.5 0 0 1-1.5-1.5v-5Z"/></svg>
                        <span class="font-medium">Gestión Académica</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="h-4 w-4 text-slate-300 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                </button>
                <ul x-show="open" x-collapse class="py-1">
                    <li><a href="#" data-role="CU6" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"/></svg>Registrar docentes</a></li>
                    <li><a href="#" data-role="CU7" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10M4 18h10"/></svg>Gestionar materias</a></li>
                    <li><a href="#" data-role="CU8" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h6"/></svg>Gestionar grupos</a></li>
                    <li><a href="#" data-role="CU9" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6.75A1.75 1.75 0 0 1 5.75 5h12.5A1.75 1.75 0 0 1 20 6.75v10.5A1.75 1.75 0 0 1 18.25 19H5.75A1.75 1.75 0 0 1 4 17.25V6.75Zm3 2.5h10v6.5H7v-6.5Z"/></svg>Gestionar carga horaria</a></li>
                    <li><a href="#" data-role="CU10" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Asignar grupos a docentes</a></li>
                </ul>
            </section>

            <!-- Aulas y Horarios -->
            <section x-data="{open:true}" data-module="aulas_horarios" class="rounded-lg overflow-hidden ring-1 ring-white/5">
                <button @click="open=!open" :aria-expanded="open.toString()" class="w-full flex items-center justify-between px-3 py-2 text-left bg-white/5 hover:bg-white/10 transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M3.5 6.75A1.75 1.75 0 0 1 5.25 5h13.5A1.75 1.75 0 0 1 20.5 6.75v10.5A1.75 1.75 0 0 1 18.75 19H5.25A1.75 1.75 0 0 1 3.5 17.25V6.75Z"/></svg>
                        <span class="font-medium">Aulas y Horarios</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="h-4 w-4 text-slate-300 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                </button>
                <ul x-show="open" x-collapse class="py-1">
                    <li><a href="#" data-role="CU11" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 21h14a2 2 0 0 0 2-2v-9H3v9a2 2 0 0 0 2 2Z"/></svg>Asignar horarios manualmente</a></li>
                    <li><a href="#" data-role="CU12_Horarios" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm.75 5.25a.75.75 0 0 0-1.5 0V12a.75.75 0 0 0 .22.53l3 3a.75.75 0 1 0 1.06-1.06l-2.78-2.78Z"/></svg>Gestionar horarios</a></li>
                    <li><a href="#" data-role="CU12_Aulas" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l9 4 9-4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9 4 9-4"/></svg>Gestionar aulas</a></li>
                    <li><a href="#" data-role="CU13" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 21h14M3 11h18"/></svg>Gestionar reserva de aula</a></li>
                </ul>
            </section>

            <!-- Control de Asistencia -->
            <section x-data="{open:true}" data-module="asistencia" class="rounded-lg overflow-hidden ring-1 ring-white/5">
                <button @click="open=!open" :aria-expanded="open.toString()" class="w-full flex items-center justify-between px-3 py-2 text-left bg-white/5 hover:bg-white/10 transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm3 10.75H9a.75.75 0 0 1 0-1.5h6a.75.75 0 0 1 0 1.5Z"/></svg>
                        <span class="font-medium">Control de Asistencia</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="h-4 w-4 text-slate-300 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                </button>
                <ul x-show="open" x-collapse class="py-1">
                    <li><a href="#" data-role="CU14" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Registrar asistencia docente</a></li>
                    <li><a href="#" data-role="CU15" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h6m-6 6h6m-6 6h6M8 6h.01M8 12h.01M8 18h.01"/></svg>Consultar asistencia</a></li>
                </ul>
            </section>

            <!-- Reportes y Dashboard -->
            <section x-data="{open:true}" data-module="reportes" class="rounded-lg overflow-hidden ring-1 ring-white/5 mb-6">
                <button @click="open=!open" :aria-expanded="open.toString()" class="w-full flex items-center justify-between px-3 py-2 text-left bg-white/5 hover:bg-white/10 transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5"><path d="M3 3.75A.75.75 0 0 1 3.75 3h7.5a.75.75 0 0 1 .75.75v16.5a.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3.75Zm9.75 6A.75.75 0 0 1 13.5 9h6.75a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75H13.5a.75.75 0 0 1-.75-.75V9.75Z"/></svg>
                        <span class="font-medium">Reportes y Dashboard</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="h-4 w-4 text-slate-300 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                </button>
                <ul x-show="open" x-collapse class="py-1">
                    <li><a href="#" data-role="CU16" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18"/></svg>Generar reportes académicos</a></li>
                    <li><a href="#" data-role="CU17" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8"/></svg>Exportar reportes en Excel y PDF</a></li>
                    <li><a href="#" data-role="CU18" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-sidebar-hover"><svg class="h-5 w-5 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3v18M3 12h18"/></svg>Generar dashboard</a></li>
                </ul>
            </section>
        </div>
    </nav>

    <!-- Main content -->
    <div class="flex min-h-screen flex-col">
        <!-- Top bar -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur border-b border-slate-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center gap-3 lg:hidden">
                    <div class="h-9 w-9 rounded-full bg-primary-700 flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-white"><path d="M11.7 2.04a1 1 0 0 1 .6 0l9 3a1 1 0 0 1 0 1.92l-3.2 1.07v3.02a2 2 0 0 1-1.2 1.84l-4 1.78a2 2 0 0 1-1.6 0l-4-1.78a2 2 0 0 1-1.2-1.84V8.03L1.7 6.96a1 1 0 0 1 0-1.92l9-3Z"/></svg>
                    </div>
                    <div class="font-semibold">Gestión Académica</div>
                </div>
                <div class="flex-1"></div>
                <div class="flex items-center gap-2">
                    <label for="roleSelect" class="text-sm text-slate-600">Rol:</label>
                    <select id="roleSelect" class="rounded-md border-slate-300 bg-white text-sm shadow-sm focus:ring-primary-500 focus:border-primary-500">
                        <option>Administrador</option>
                        <option>Coordinador</option>
                        <option>Docente</option>
                        <option>Autoridad</option>
                        <option>Auxiliar</option>
                    </select>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
                <!-- Welcome card -->
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 p-6">
                    <h1 class="text-xl font-bold text-slate-900">Bienvenido/a al Sistema de Gestión Académica</h1>
                    <p class="mt-2 text-slate-600">Usa el selector de rol (arriba a la derecha) para simular los permisos de navegación. El menú lateral mostrará únicamente los casos de uso habilitados para el rol seleccionado.</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-xl border border-slate-200 p-4">
                            <div class="font-medium text-slate-800 mb-1">Módulos</div>
                            <ul class="list-disc list-inside text-slate-600 text-sm">
                                <li>Administración de Usuarios y Seguridad</li>
                                <li>Gestión Académica</li>
                                <li>Aulas y Horarios</li>
                                <li>Control de Asistencia</li>
                                <li>Reportes y Dashboard</li>
                            </ul>
                        </div>
                        <div class="rounded-xl border border-slate-200 p-4">
                            <div class="font-medium text-slate-800 mb-1">Consejo</div>
                            <p class="text-slate-600 text-sm">Este dashboard es sólo la interfaz. Puedes enlazar cada caso de uso a tus rutas reales modificando los href del sidebar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-4 text-center text-xs text-slate-500">FICCT — Sistema de Gestión Académica</footer>
    </div>
</div>

<script>
    // Mapa de permisos por rol
    const permisos = {
        Administrador: ['CU1','CU2','CU3','CU4','CU5','CU6','CU7','CU8','CU9','CU12_Aulas','CU13'],
        Coordinador:   ['CU1','CU2','CU3','CU6','CU7','CU8','CU9','CU10','CU11','CU12_Horarios','CU13','CU15','CU16','CU17','CU18'],
        Docente:       ['CU1','CU2','CU3','CU14'],
        Autoridad:     ['CU1','CU2','CU3','CU15','CU16','CU17','CU18'],
        Auxiliar:      ['CU1','CU2','CU3','CU12_Aulas','CU13']
    };

    function updateSidebarByRole(role) {
        const allowed = permisos[role] || [];
        document.querySelectorAll('[data-role]')
            .forEach(el => el.classList.toggle('hidden', !allowed.includes(el.getAttribute('data-role'))));
        // Atenuar secciones sin items visibles
        document.querySelectorAll('[data-module]').forEach(section => {
            const visible = section.querySelectorAll('[data-role]:not(.hidden)').length;
            section.classList.toggle('opacity-40', visible === 0);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const select = document.getElementById('roleSelect');
        const saved = localStorage.getItem('ui.role');
        if (saved && permisos[saved]) {
            select.value = saved;
        }
        updateSidebarByRole(select.value);
        select.addEventListener('change', () => {
            localStorage.setItem('ui.role', select.value);
            updateSidebarByRole(select.value);
        });
    });
</script>
</body>
</html>


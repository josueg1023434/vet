<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Mejora de diseño */
        .navbar {
            background-color: #28a745; /* Verde relacionado con veterinarias */
        }

        .navbar-brand {
            color: #FFFFFF !important;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            color: #FFFFFF !important;
        }

        .navbar-nav .nav-link:hover {
            color: #FFD700 !important; /* Hover color */
        }

        .container {
            margin-top: 50px;
        }

        /* Tabla estilizada */
        .table th {
            background-color: #28a745;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
        <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">Mi Aplicación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        @can('Gestionar Roles')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                            </li>
                        @endcan
                        @canany(['Crear Usuarios', 'Editar Usuarios', 'Eliminar Usuarios'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                            </li>
                        @endcanany

                        @canany(['Ver Animales', 'Editar Animal'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mascotas.index') }}">Mascotas</a>
                            </li>
                        @endcanany

                        @canany(['Agendar Cita', 'Editar Cita', 'Cancelar Cita', 'Ver Citas'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('citas.index') }}">Citas</a>
                            </li>
                        @endcanany
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                    @endguest
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mensajes Flash -->
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Contenido Principal -->
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria Huellitas - Bienvenidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50; /* Verde principal */
            --secondary-color: #f5f5f5; /* Fondo claro */
            --text-color: #ffffff; /* Texto claro */
            --btn-color: #FF7A00; /* Botones principales */
        }

        body {
            background-color: var(--secondary-color);
            color: #333;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: var(--text-color);
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #cce7d0;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/veterinaria-bg.jpg') no-repeat center center/cover;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--text-color);
        }

        .hero-section h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .hero-section p {
            font-size: 1.2rem;
        }

        .btn-orange {
            background-color: var(--btn-color);
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .btn-orange:hover {
            background-color: #e56a00;
        }

        .services-section {
            padding: 40px 0;
        }

        .services-section h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .service-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: 15px;
        }

        .service-card h3 {
            margin-top: 15px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .footer {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 15px 0;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Veterinaria Huellitas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointments.php">Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="medical_records.php">Historial Médico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="billing.php">Facturación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">Sobre Nosotros</a>
                    </li>
                </ul>
                            @if (Auth::check())
                <!-- Si el usuario está autenticado, mostrar su nombre -->
                <span class="navbar-text">
                    Hola, {{ Auth::user()->nombre }}
                </span>
            @else
                <!-- Si el usuario no está autenticado, mostrar el botón de iniciar sesión -->
                <a href="{{ route('login') }}" class="btn btn-orange me-2">Iniciar Sesión</a>
            @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div>
            <h1>Bienvenido a Veterinaria Huellitas</h1>
            <p>Atención de calidad para tus mascotas, porque ellas son parte de tu familia.</p>
            <a href="appointments.php" class="btn btn-orange">Agenda tu cita</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <h2>Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="imagenes/tratamiento_mascotas.webp" alt="Consulta" class="img-fluid">
                        <h3>Consultas Médicas</h3>
                        <p>Revisión y diagnóstico de la salud de tu mascota.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="imagenes/cirugia.webp" alt="Cirugía" class="img-fluid">
                        <h3>Cirugía Veterinaria</h3>
                        <p>Intervenciones quirúrgicas seguras y profesionales.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="imagenes/vacunas.png" alt="Vacunas" class="img-fluid">
                        <h3>Vacunación</h3>
                        <p>Protege a tu mascota con nuestro programa de vacunas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Veterinaria Huellitas. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <h5 class="text-center py-3 text-success">Huellitas</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-house-door me-2"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-calendar-check me-2"></i> Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-person-lines-fill me-2"></i> Propietarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-paw me-2"></i> Mascotas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-box-seam me-2"></i> Inventario
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-wallet2 me-2"></i> Finanzas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-bar-chart-line me-2"></i> Informes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-gear me-2"></i> Configuración
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-10 ms-sm-auto px-4">
            <!-- Estadísticas -->
            <div class="row mt-4">
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm" style="border-left: 5px solid #4CAF50;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-success">Citas atendidas</h6>
                                    <h4>3263</h4>
                                </div>
                                <i class="bi bi-calendar3 text-muted" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm" style="border-left: 5px solid #FFC107;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-warning">Pacientes registrados</h6>
                                    <h4>891</h4>
                                </div>
                                <i class="bi bi-clipboard text-muted" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm" style="border-left: 5px solid #17A2B8;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-info">Pacientes hospitalizados</h6>
                                    <h4>19</h4>
                                </div>
                                <i class="bi bi-hospital text-muted" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm" style="border-left: 5px solid #E74C3C;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-danger">Egresos diarios</h6>
                                    <h4>$0</h4>
                                </div>
                                <i class="bi bi-cash-coin text-muted" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

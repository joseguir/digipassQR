@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Administración</h1>
@stop

@section('content')

@if (auth()->user()->role_id == 2)
    <div class="row">
        
        {{-- COLUMNA IZQUIERDA: GRÁFICO DE LÍNEAS (Ventas a lo largo del tiempo) --}}
        {{-- COLUMNA IZQUIERDA --}}
        <div class="col-md-6"> 
            
            {{-- 1. GRÁFICO DE LÍNEAS (Ventas a lo largo del tiempo) --}}
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <canvas id="ventasLineaChart" style="height: 250px;"></canvas>
                </div>
            </div>
            
            {{-- 2. TARJETA DE LOTES (Reemplazando Notificaciones) --}}
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tags"></i>
                        Top 5 Lotes de Entradas
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="max-height: 200px; overflow-y: auto;">
                    {{-- Lista de Lotes (List Group) --}}
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-money-bill-wave text-success mr-2"></i> 
                            **Lote VIP (Concierto Rock)**
                            <span class="float-right badge badge-success">$45.000 USD</span>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-clock text-info mr-2"></i> 
                            **Lote Early Bird (Festival Jazz)**
                            <span class="float-right badge badge-info">$28.000 USD</span>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-users text-warning mr-2"></i> 
                            **Lote General (Concierto Rock)**
                            <span class="float-right badge badge-warning">$22.500 USD</span>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-shopping-cart text-primary mr-2"></i> 
                            **Lote Promoción 2x1 (Taller Cocina)**
                            <span class="float-right badge badge-primary">$15.000 USD</span>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-building text-secondary mr-2"></i> 
                            **Lote Corporativo (Feria de Arte)**
                            <span class="float-right badge badge-secondary">$10.000 USD</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="#">Ver Gestión de Lotes y Tiers</a>
                </div>
            </div>
            
        </div>
        {{-- FIN COLUMNA IZQUIERDA --}}

        {{-- COLUMNA DERECHA (NUEVA ESTRUCTURA) --}}
        <div class="col-md-6">
            
            {{-- 3. GRÁFICO DE BARRAS: RENDIMIENTO VS. META (Para varios eventos) --}}
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i>
                        Rendimiento de Ingresos por Evento
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="organizadorBarrasChart" style="height: 200px;"></canvas>
                </div>
            </div>
            
            {{-- 4. GRÁFICO DE DONA: VENTAS VS. CAPACIDAD (Para el evento principal) --}}
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-ticket-alt"></i>
                        Ventas vs. Capacidad (Evento Principal)
                    </h3>
                </div>
                <div class="card-body">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <canvas id="capacidadChart" style="height: 220px; max-width: 250px;"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
        {{-- FIN COLUMNA DERECHA --}}

    </div>

    @elseif (auth()->user()->role_id == 1)
       <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-shield"></i> Tipos de Usuarios
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="usuariosTipoChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>

             <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt"></i> Eventos Totales
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="eventosTotalesChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        <!-- GANANCIAS TOTALES -->
        <div class="col-md-6">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-dollar-sign"></i> Ganancias Totales
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="gananciasTotalesChart" style="height:260px;"></canvas>
                </div>
            </div>
        </div>

        <!-- TOP ORGANIZADORES POR VENTAS -->
        <div class="col-md-6">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i> Top Organizadores
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="topOrganizadoresChart" style="height:260px;"></canvas>
                </div>
            </div>
    </div>

    @elseif (auth()->user()->role_id == 3)

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="card card-info card-outline">
                <div class="card-header text-center">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i> Mi Perfil
                    </h3>
                </div>

                <div class="card-body">

                    <div class="text-center mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" 
                            alt="Avatar" 
                            style="width: 100px; border-radius: 50%;">
                    </div>

                    <table class="table table-borderless">
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>

                        <tr>
                            <th>Email:</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>

                        <tr>
                            <th>Registrado el:</th>
                            <td>{{ auth()->user()->created_at->format('d/m/Y') }}</td>
                        </tr>
                    </table>

                </div>

                <div class="card-footer text-center">
                    <a href="#" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Editar Perfil
                    </a>
                </div>

            </div>

        </div>
    </div>



</div>

    
    @else
        {{-- VISTA PARA CUALQUIER OTRO ROL NO ESPECIFICADO --}}
        <div class="alert alert-warning">
            No tienes un panel de control asignado para tu rol.
        </div>
    @endif
@stop


@section('js')

    @if (auth()->user()->role_id == 2)
        {{-- CHART.JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.umd.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                console.info('[Dashboard] Inicializando gráficos del organizador...');

                // -------------------------------------------------------------------
                // 1. GRÁFICO DE LÍNEAS (Ventas por día)
                // -------------------------------------------------------------------
                const lineaCtx = document.getElementById('ventasLineaChart');

                if (lineaCtx) {
                    console.info('[Dashboard] Gráfico: Ventas por día');

                    const lineaLabels = ['Día -6', 'Día -5', 'Día -4', 'Día -3', 'Día -2', 'Ayer', 'Hoy'];
                    const entradasVendidas = [120, 150, 90, 200, 250, 180, 310]; 

                    new Chart(lineaCtx.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: lineaLabels,
                            datasets: [{
                                label: 'Entradas Vendidas',
                                data: entradasVendidas,
                                backgroundColor: 'rgba(60, 141, 188, 0.5)',
                                borderColor: 'rgba(60, 141, 188, 1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: { display: true, text: 'Entradas Vendidas' }
                                }
                            }
                        }
                    });
                } else {
                    console.warn('[Dashboard] Canvas ventasLineaChart no encontrado.');
                }

                // -------------------------------------------------------------------
                // 2. GRÁFICO DE BARRAS (Ingresos por evento)
                // -------------------------------------------------------------------
                const barrasCtx = document.getElementById('organizadorBarrasChart');

                if (barrasCtx) {
                    console.info('[Dashboard] Gráfico: Ingresos por evento');

                    const organizerLabels = ['Concierto Rock', 'Feria de Arte', 'Taller Cocina'];
                    const recaudadoData = [15000, 8500, 4200];

                    new Chart(barrasCtx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: organizerLabels,
                            datasets: [{
                                label: 'Ingresos Recaudados ($)',
                                data: recaudadoData,
                                backgroundColor: 'rgba(40, 167, 69, 1)',
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            indexAxis: 'y',
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: { display: true, text: 'Monto Recaudado ($)' }
                                }
                            }
                        }
                    });
                } else {
                    console.warn('[Dashboard] Canvas organizadorBarrasChart no encontrado.');
                }

                // -------------------------------------------------------------------
                // 3. GRÁFICO DE DONA (Ventas vs capacidad)
                // -------------------------------------------------------------------
                const donaCtx = document.getElementById('capacidadChart');

                if (donaCtx) {
                    console.info('[Dashboard] Gráfico: Capacidad vs Ventas');

                    const vendidas = 750;
                    const capacidadTotal = 1000;
                    const restantes = capacidadTotal - vendidas;

                    new Chart(donaCtx.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Vendidas', 'Restantes'],
                            datasets: [{
                                data: [vendidas, restantes],
                                backgroundColor: ['#007BFF', '#CED4DA'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: true, position: 'bottom' },
                                title: {
                                    display: true,
                                    text: `Total: ${capacidadTotal} - ${(vendidas / capacidadTotal * 100).toFixed(1)}% Vendido`
                                }
                            }
                        }
                    });
                } else {
                    console.warn('[Dashboard] Canvas capacidadChart no encontrado.');
                }

            });
        </script>
    @endif

        {{-- =============================================== --}}
    {{-- JS EXCLUSIVO PARA EL ADMIN (role_id == 1) --}}
    {{-- =============================================== --}}
    @if (auth()->user()->role_id == 1)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.umd.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

        console.info('[Admin] Inicializando gráfico de tipos de usuarios...');

        const usuariosTipoCtx = document.getElementById('usuariosTipoChart');

        if (usuariosTipoCtx) {

            // Datos fijos por ahora
            const organizadores = 25; 
            const clientes = 125;     

            console.info('[Admin] Gráfico: Organizadores vs Clientes');

            new Chart(usuariosTipoCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Organizadores', 'Clientes'],
                    datasets: [{
                        data: [organizadores, clientes],
                        backgroundColor: ['#007bff', '#ffc107'], 
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: { display: true, position: 'bottom' },
                        title: {
                            display: true,
                            text: `Total Usuarios: ${organizadores + clientes}`
                        }
                    }
                }
            });

        } else {
            console.warn('[Admin] Canvas usuariosTipoChart no encontrado.');
        }

          // =========================================
    // GRÁFICO: Eventos Totales (NUEVO)
    // =========================================
    console.info('[Admin] Inicializando gráfico de eventos totales...');

    const eventosTotalesCtx = document.getElementById('eventosTotalesChart');

            if (eventosTotalesCtx) {

                new Chart(eventosTotalesCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                        datasets: [{
                            label: 'Eventos Totales',
                            data: [30, 45, 50, 40, 55, 60], // DATOS FIJOS
                            borderWidth: 1,
                            backgroundColor: '#28a745'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });

            } else {
                console.warn('[Admin] Canvas eventosTotalesChart no encontrado.');
            }

            /* ============================================================
       1. GRÁFICO: GANANCIAS TOTALES (DATOS FIJOS)
    ============================================================ */
    const gananciasCtx = document.getElementById('gananciasTotalesChart');

    if (gananciasCtx) {
        console.info('[Admin] Cargando gráfico de Ganancias Totales...');

        const meses = ['Enero', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];
        const ganancias = [12000, 15000, 18000, 14000, 21000, 25000]; 

        new Chart(gananciasCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: meses,
                datasets: [
                    {
                        label: 'Ganancias ($)',
                        data: ganancias,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.3)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: `Ganancia total: $${ganancias.reduce((a, b) => a + b)}`
                    },
                    legend: { display: true }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }


    /* ============================================================
       2. GRÁFICO: TOP ORGANIZADORES POR VENTAS
    ============================================================ */
    const organizadoresCtx = document.getElementById('topOrganizadoresChart');

    if (organizadoresCtx) {
        console.info('[Admin] Cargando gráfico Top Organizadores...');

        const organizadores = ['Juan Pérez', 'Eventos Sur', 'La Noche Live', 'Org Pro'];
        const ventas = [3500, 2800, 1900, 1500]; 

        new Chart(organizadoresCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: organizadores,
                datasets: [{
                    label: 'Entradas Vendidas',
                    data: ventas,
                    backgroundColor: ['#17a2b8', '#007bff', '#6610f2', '#6f42c1']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // Barras horizontales
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Top Organizadores por Ventas'
                    }
                    },
                    scales: {
                        x: { beginAtZero: true }
                    }
                }
            });
        }

    });
    </script>
@endif



@stop


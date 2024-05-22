<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
  header("Location: Centro_psicosocial/ingreso/ingreso.php");
  exit();
}

// Conecta a la base de datos (asegúrate de incluir la conexión)
include("validacion.php");

// Obtén la información del usuario en sesión
$usuario_id = $_SESSION["usuario_id"];
$sql = "SELECT nombre FROM usuarios WHERE id = $usuario_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nombreUsuario = $row["nombre"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cerrar_sesion"])) {
    // Cierra la sesión y redirige al usuario a la página de inicio
    session_destroy();
    header("Location: ../../index.php");
    exit();
}

// Consulta SQL para obtener la lista de pacientes
$sql = "SELECT persona_id, nombre FROM persona";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/pantalla.png">
    <link rel="icon" type="image/png" href="../assets/img/pantalla.png">
    <title>
        Software de Seguimiento Clínico
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/material-dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/css/estilo_evolucion.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script>
        // Función para mostrar u ocultar las tarjetas según la opción seleccionada
        function mostrarOpcion(opcion) {
            // Oculta todas las tarjetas
            document.getElementById("infoPaciente").style.display = "none";
            document.getElementById("infoAntecedentes").style.display = "none";
            document.getElementById("ingresarEvolucion").style.display = "none";

            // Muestra la tarjeta correspondiente a la opción seleccionada
            document.getElementById(opcion).style.display = "block";
        }
    </script>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
                <img src="../assets/img/pantalla.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Seguimiento Clínico</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white active bg-gradient-primary" href="../pages/dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/pacientes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Pacientes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/antecedentes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Antecedentes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/medicos.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Psicologos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/practicante.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Practicantes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/sesiones.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-symbols-outlined"> quick_reference_all </i>
                        </div>
                        <span class="nav-link-text ms-1"> Registro de sesiones </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/evoluciones.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Seguimiento - Pacientes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/seguimiento.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Evolución</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../ingreso/ingreso.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                        </div>
                        <form method="POST" class="cerrar-sesion-form">
                        <button type="submit" name="cerrar_sesion" class="cerrar-sesion-button">Cerrar Sesión</button>
                        </form>
                    </a>
                </li>

            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn bg-gradient-primary w-100" href="https://www.uniclaretiana.edu.co/" type="button"> Ir a Uniclaretiana</a>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Seguimiento Clínico</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Seguimientos/Evoluciones - Paciente</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Seguimiento - Paciente</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>

                    <li class="nav-item d-flex align-items-center">
                        <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">

                            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                    <h6>Bienvenido, <?php echo $nombreUsuario; ?></h6>
          
                                </div>

                            </div>
             
                        </a>
                    </li>
                    
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-lg-10 col-md-10 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Bienvenido, aqui podrá ver la evolución, seguimiento y la información necesaria de cada paciente en el sistema.</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <br>

            <div class="div class="col-12">     
                <div class="card my-4">     
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"> 
                            <h6 class="text-white text-capitalize ps-3">Información de seguimiento de pacientes</h6>   

                        </div>
                    </div>  

                    
                    <div class="card"> 
                        <div class="card-body">     
                            <h6>Información de antecedentes registrados en el sistema</h6>  
                            <!-- Formulario de selección de paciente -->    
                            <form method="post" action="">  
                                <label for="paciente_id">Paciente:</label>  
                                <select name="paciente_id">     
                                    <option value="">Seleccione un paciente</option>    

                                    <?php   
                                        // Consulta SQL para seleccionar pacientes  
                                        $sqlPacientes = "SELECT persona_id, nombre FROM persona";
                                        $resultPacientes = $conn->query($sqlPacientes);     

                                        if ($resultPacientes->num_rows > 0){    
                                            while ($row = $resultPacientes->fetch_assoc()) {    
                                                echo "<option value=\"" . $row["persona_id"] . "\">" . $row["nombre"] . "</option>";    
                                            }   
                                        } else {    
                                            echo "<option value=\"0\">No hay pacientes disponibles</option>";
                                        }
                                    ?>      
                                </select>   
                                <br>    
                                <input type="submit" name="seleccionar_paciente" value="Seleccionar">   
                            </form>  
                             
                            <div id="infoPaciente">
                                <?php   
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["seleccionar_paciente"])) { 
                                        $selectedPatientId = $_POST["paciente_id"];     

                                          
                                        $sqlInfoPaciente = "SELECT nombre, fecha_nacimiento, motivo_consulta
                                                            FROM persona
                                                            WHERE persona_id = ?";      

                                        // Preparar la sentencia    
                                        $stmtInfoPaciente = $conn->prepare($sqlInfoPaciente);   

                                        // Vincular el parámetro    
                                        $stmtInfoPaciente->bind_param("i", $selectedPatientId); // "i" indica un entero     

                                        // Ejecutar la consulta     
                                        $stmtInfoPaciente->execute();   

                                        // Obtener resultados   
                                        $resultInfoPaciente = $stmtInfoPaciente->get_result();      

                                        if ($resultInfoPaciente->num_rows > 0) {    
                                            $rowPaciente = $resultInfoPaciente->fetch_assoc();  
                                            // Calcula la edad del paciente 
                                            $fechaNacimiento = new DateTime($rowPaciente['fecha_nacimiento']);
                                            $fechaActual = new DateTime();
                                            $edad = $fechaNacimiento->diff($fechaActual)->y;    

                                            // Muestra la información del paciente seleccionado 
                                            echo "<br><h6>Información del Paciente Seleccionado:</h6>"; 
                                            echo "Nombre: " . $rowPaciente['nombre'] . "<br>";
                                            echo "Edad: " . $edad . " años<br>"; 
                                            echo "Motivo de consulta: " . $rowPaciente['motivo_consulta'] . "<br>";   

                                            //consulta SQL para obtener los antecedentes patológicos
                                            $sqlAntecedentes = "SELECT patologicos, quirurgicos, psicopatologicos, traumaticos, consumo_sustancias, otros
                                                            FROM antecedente_f
                                                            WHERE persona_id = ?";      

                                            $stmtAntecedentes = $conn->prepare($sqlAntecedentes);
                                            $stmtAntecedentes->bind_param("i", $selectedPatientId);
                                            $stmtAntecedentes->execute();
                                            $resultAntecedentes = $stmtAntecedentes->get_result();      

                                            if ($resultAntecedentes->num_rows > 0) {    
                                                $rowAntecedentes = $resultAntecedentes->fetch_assoc();  
                                                // Muestra los antecedentes  
                                                echo "<br><h6>Información de los antecedentes del Paciente Seleccionado:</h6>";     
                                                echo "Antecedentes patológicos: " . $rowAntecedentes['patologicos'] . "<br>";
                                                echo "Antecedentes quirurgicos: " . $rowAntecedentes['quirurgicos'] . "<br>";
                                                echo "Antecedentes psicopatologicos: " . $rowAntecedentes['psicopatologicos'] . "<br>";
                                                echo "Antecedentes traumaticos: " . $rowAntecedentes['traumaticos'] . "<br>";
                                                echo "Consumo de sustancias: " . $rowAntecedentes['consumo_sustancias'] . "<br>";
                                                echo "Otros antecedentes: " . $rowAntecedentes['otros'] . "<br><br>";   
                                            } else {   
                                                echo "No se encontraron antecedentes familiares y personales registrados para este paciente.<br><br>";
                                            }

                                        
                                                
                                                //consulta SQL para obtener las sesiones
                                                $sqlSesiones = "SELECT fecha_sesion, estado_paciente, tareas
                                                                FROM sesiones
                                                                WHERE id_paciente = ?";

                                                // Preparar la sentencia
                                                $stmtSesiones = $conn->prepare($sqlSesiones);

                                                // Vincular el parámetro
                                                $stmtSesiones->bind_param("i", $selectedPatientId);

                                                // Ejecutar la consulta
                                                $stmtSesiones->execute();

                                                // Obtener resultados
                                                $resultSesiones = $stmtSesiones->get_result();

                                                // Verificar si hay resultados
                                                if ($resultSesiones !== false) {
                                                    // Verificar si hay sesiones registradas
                                                    if ($resultSesiones->num_rows > 0) {
                                                        echo "<br><h6>Información de sesiones del Paciente Seleccionado:</h6>";
                                                        // Muestra la información de cada sesión
                                                        while ($rowSesiones = $resultSesiones->fetch_assoc()) {
                                                            echo "Fecha de Sesión: " . $rowSesiones['fecha_sesion'] . "<br>";
                                                            echo "Estado del Paciente: " . $rowSesiones['estado_paciente'] . "<br>";
                                                            echo "Tareas: " . $rowSesiones['tareas'] . "<br><br>";
                                                        }
                                                    } else {
                                                        echo "No se encontraron sesiones registradas para este paciente.<br><br>";
                                                    }
                                                } else {
                                                    // Manejar el error de la consulta
                                                    die("Error en la consulta de sesiones: " . $stmtSesiones->error);
                                                }

                                                // Cerrar la consulta preparada
                                                $stmtSesiones->close();

                                                // Cerrar la conexión
                                                $conn->close();

                                                
                                            

                                        }
                                    }
                                ?>
                            </div>
                                
                            
                        </div>

                        
                    </div>
  
                    
                </div>    
                    
                


            
            </div>
            


        </div>

        

    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Configuración</h5>
                    <p>Opciones.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Barra de colores</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Fondo de barra</h6>
                    <p class="text-sm">Elija el que más se adapte a su estilo.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Barra de navegación fija</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        //preguntar este js

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: [50, 20, 10, 22, 50, 10, 40],
                    maxBarThickness: 6
                },],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>


</body>

</html>
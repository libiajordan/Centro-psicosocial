<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
  header("Location: Centro_psicosocial/ingreso/ingreso.php");
  exit();
}

// Conexión a la base de datos 
include("validacion.php");

// Inicializar la variable para evitar el error de "Undefined variable"
$nombreUsuario = "";

// Información del usuario en sesión
$usuario_id = $_SESSION["usuario_id"];
$sql = "SELECT nombre, id_rol FROM usuarios WHERE id = $usuario_id";
$result = $conn->query($sql);

// Verificar si hay al menos una fila en el resultado
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreUsuario = $row["nombre"];
    $rolUsuario = $row["id_rol"];
}

if ($result->num_rows == 3) {
    $row = $result->fetch_assoc();
    $nombreUsuario = $row["nombre"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cerrar_sesion"])) {
    // Cierra la sesión y redirige al usuario a la página de inicio
    session_destroy();
    header("Location: ../../index.php");
    exit();
}
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
    <link href="../assets/css/style6.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/ /material-dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
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
                    <a class="nav-link text-white active bg-gradient-primary" href="../rol/dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../rol/pacientes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Pacientes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../rol/antecedentes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Antecedentes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../rol/sesiones.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-symbols-outlined"> quick_reference_all </i>
                        </div>
                        <span class="nav-link-text ms-1"> Registro de sesiones </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../rol/evoluciones.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Seguimiento - Pacientes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../rol/seguimiento.php">
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Antecedentes</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Antecedentes</h6>
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
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card my-4"> 
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"> 
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"> 
                                <h6 class="text-white text-capitalize ps-3">Registrar antecedentes</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="container">
                                <h6>A continuación, elija el paciente a crear registro y llene el formulario.</h6>

                                </div>

                            </div>
                        </div>


                      
                        
                    </div>
                </div>

                <div class="row">   
                    <div class="col-md-6 mb-4">     
                        <div class="card">
                            <div class="card-header bg-gradient-primary text-white">
                                <h6 class="mb-0">Registrar antecedentes familiares</h6>
                            </div>  
                            <div class="card-body">
                                <button id="crearRegistroBtn">Crear registro</button>   
                                <div id="formularioRegistro" style="display: none;">

                                        
                                    <form id="formulario" method="POST" action="guardar_registro.php">
                                        
                                        
                                        <?php include 'paciente_select.php'; ?>

                                        <br>

                                        <div style="display: inline-block; width: 45%;" >

                                            <label for="patologicos">Antecedentes Patologicos:</label>
                                            <input type="text" id="patologicos" name="patologicos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="quirurgicos">Antecedentes Quirurgicos:</label>
                                            <input type="text" id="quirurgicos" name="quirurgicos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="psicopatologicos">Antecedentes psicopatologicos:</label>
                                            <input type="text" id="psicopatologicos" name="psicopatologicos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="traumaticos">Antecedentes Traumaticos:</label>
                                            <input type="text" id="traumaticos" name="traumaticos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="consumo_sustancias">Consumo de sustancias:</label>
                                            <input type="text" id="consumo_sustancias" name="consumo_sustancias" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="otros">Otros antecedentes:</label>
                                            <input type="text" id="otros" name="otros" required>
                                        </div>

                                        <br>
                                        <button type="submit">Guardar registro</button>
                                        <button type="button" id="cerrarFormulario">Cerrar Formulario</button>
                                    
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">     
                        <div class="card">
                            <div class="card-header bg-gradient-primary text-white">
                                <h6 class="mb-0">Registrar antecedentes personales</h6> 
                            </div>  

                            <div class="card-body">
                                <button id="crearRegistroBtn1">Crear registro</button>  
                                <div id="formularioRegistro1" style="display: none;">

                                        
                                    <form id="formulario" method="POST" action="guardar_antecedentes.php">
                                        
                                        
                                        <?php include 'paciente_select.php'; ?>

                                        <br>

                                        <div style="display: inline-block; width: 45%;" >

                                            <label for="patologicos">Antecedentes Patologicos:</label>
                                            <input type="text" id="patologicos" name="patologicos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="quirurgicos">Antecedentes Quirurgicos:</label>
                                            <input type="text" id="quirurgicos" name="quirurgicos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="psicopatologicos">Antecedentes psicopatologicos:</label>
                                            <input type="text" id="psicopatologicos" name="psicopatologicos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="traumaticos">Antecedentes Traumaticos:</label>
                                            <input type="text" id="traumaticos" name="traumaticos" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="consumo_sustancias">Consumo de sustancias:</label>
                                            <input type="text" id="consumo_sustancias" name="consumo_sustancias" required>
                                        </div>

                                        <div style="display: inline-block; width: 45%;">
                                            <label for="otros">Otros antecedentes:</label>
                                            <input type="text" id="otros" name="otros" required>
                                        </div>

                                        <br>
                                        <button type="submit">Guardar registro</button>
                                        <button type="button" id="cerrarFormulario1">Cerrar Formulario</button>
                                    
                                    </form>


                                </div>
                            </div>

                        </div>

                    </div>


                </div>

                <script>    
                
                    document.addEventListener("DOMContentLoaded", function () {
                        const crearRegistroBtn = document.getElementById("crearRegistroBtn");
                        const formularioRegistro = document.getElementById("formularioRegistro");
                        const cerrarFormularioBtn = document.getElementById("cerrarFormulario");

                        crearRegistroBtn.addEventListener("click", function () {
                            formularioRegistro.style.display = "block";
                        });

                        cerrarFormularioBtn.addEventListener("click", function () {
                            formularioRegistro.style.display = "none";
                        });

                        const crearRegistroBtn1 = document.getElementById("crearRegistroBtn1");
                        const formularioRegistro1 = document.getElementById("formularioRegistro1");
                        const cerrarFormulario1 = document.getElementById("cerrarFormulario1");

                        crearRegistroBtn1.addEventListener("click", function () {
                            formularioRegistro1.style.display = "block";
                        });

                        cerrarFormulario1.addEventListener("click", function () {
                            formularioRegistro1.style.display = "none";
                        });
                    });

                </script>
                

              
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
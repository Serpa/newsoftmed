<?php
session_start();
if (isset($_SESSION['login'])) {
    //login ok!
} else {
    header('location: ./login.php');
} ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>SOFTMED-Software de gestão de Clínicas Médicas</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/atlantis.min.css">

</head>

<body data-background-color="white">
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark2">

                <a href="index.html" class="logo">
                    <img src="img/logo.svg" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">

                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4><?php echo $_SESSION['nomeFuncionario']; ?></h4>
                                                <p class="text-muted"><?php echo $_SESSION['email']; ?></p><a href="./profile.php" class="btn btn-xs btn-secondary btn-sm">Ver Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./profile.php">Meu Perfil</a>
                                        <a class="dropdown-item" href="#">Alterar senha</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./logout.php">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="dark2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?php echo $_SESSION['nomeFuncionario']; ?>
                                    <span class="user-level"><?php echo $_SESSION['descricao']; ?></span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">Meu Perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Editar Perfil</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                <p>Menu Principal</p>
                            </a>
                        </li>

                        <?php
                        if ($_SESSION['idCargo'] == 1) {
                            echo '<li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#funcionarios">
                                <i class="fas fa-user-md"></i>
                                <p>Funcionários</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="funcionarios">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="cadastrar_funcionario.php">
                                            <span class="sub-item">Cadastrar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="consultar_funcionario.php">
                                            <span class="sub-item">Consultar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#cargos">
                                <i class="fas fa-plus-square"></i>
                                <p>Cargos</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="cargos">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="cadastrar_cargo.php">
                                            <span class="sub-item">Cadastrar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="consultar_cargo.php">
                                            <span class="sub-item">Consultar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>';
                        } ?>


                        <?php
                        if ($_SESSION['idCargo'] == 2 || $_SESSION['idCargo'] == 3) {
                            echo '<li class="nav-item">
                            <a data-toggle="collapse" href="#pacientes">
                                <i class="fas fa-users"></i>
                                <p>Pacientes</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="pacientes">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="cadastrar_paciente.php">
                                            <span class="sub-item">Cadastrar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="consultar_paciente.php">
                                            <span class="sub-item">Consultar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#consultas">
                                <i class="fas fa-users"></i>
                                <p>Consultas</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="consultas">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="agendar_consulta.php">
                                            <span class="sub-item">Agendar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listar_consulta.php">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>';
                        } ?>

                        <?php
                        if ($_SESSION['idCargo'] == 3) {
                            echo
                                '<li class="nav-item">
                            <a data-toggle="collapse" href="#prontuario">
                                <i class="fas fa-users"></i>
                                <p>Prontuário</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="prontuario">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="prontuario.php">
                                            <span class="sub-item">Procurar</span>
                                        </a>
                                    </li>                          
                                </ul>
                            </div>
                        </li>';
                        } ?>





                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
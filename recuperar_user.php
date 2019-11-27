<?php
include_once "dao/conexao.php";
if (isset($_GET['lost'])) {
    $lostPass = $_GET['lost'];
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuario WHERE lostPass = '$lostPass'")) == 0) {
        echo "<script>alert('Não há requisição para alteração de senha desse usuário!');window.location='login.php'</script>";
    }
} else {
    header('location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>SOFTMED-Sistema de gestão de Clínicas Médicas</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="img/logo.ico" type="image/x-icon" />

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
    <link rel="stylesheet" href="css/select2.min.css" />
    <link rel="stylesheet" href="css/select2-bootstrap.min.css" />


    <script src="jquery/jquery.min.js"></script>
    <script src="js/select2.min.js"></script>

</head>

<body data-background-color="white">
    <div class="wrapper">
        <div class="main-header">

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
                <div class="logo-header" data-background-color="dark">

                    <a class="logo">
                        <img src="img/logo.svg" alt="navbar brand" class="navbar-brand">
                        <font color="white"> <strong>SOFTMED</strong></font>
                    </a>

                </div>
            </nav>
        </div>

        <!-- End Navbar -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <!-- Start Content -->
                                    <div class="card-title">Alteração de Senha</div>
                                </div>
                                <form class="form-horizontal style-form" action="atualiza_user.php" method="post">

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Usuário</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="user" required="required" value="<?php $nome_user = mysqli_query($con, "SELECT * FROM usuario WHERE lostPass = '$lostPass'");
                                                                                                                            if (mysqli_num_rows($nome_user) > 0) {
                                                                                                                                $result_user = mysqli_fetch_array($nome_user);
                                                                                                                                echo $result_user['user'];
                                                                                                                            }
                                                                                                                            ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Senha</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" name="pass" required="required">
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" name="idUsuario" required="required" value="<?php echo $result_user['idUsuario']; ?>">
                                    <input type="hidden" class="form-control" name="lostPass" required="required" value="<?php echo $lostPass; ?>">
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-danger" onClick="window.location.href='Index.php'">Cancelar</button>

                                        <button type="submit" class="btn btn-theme">Enviar</button>
                                    </div>
                                </form>
                                <!-- End Content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="jquery/jquery-3.4.1.min.js"></script>
        <script src="js/states.js"></script>
        <script src="js/mascaras.js"></script>

        <?php
        include_once "footer.php";
        ?>
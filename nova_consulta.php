<?php
include_once "dao/conexao.php";
include_once "header.php";
$idConsulta = $_GET['id'];
$idPaciente = $_GET['pac'];
?>

<link href="./froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./froala-editor/js/froala_editor.pkgd.min.js"></script>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Start Content -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Nova Consulta</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Histórico de Consultas</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <form name="consulta">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nome do Paciente</label>
                                            <select name="pac" id="pac" class="form-control" style="width: 100%" disabled>
                                                <option></option>
                                                <?php
                                                $resultado_cargos = mysqli_query($con, "SELECT * FROM paciente");
                                                while ($row_cargos = mysqli_fetch_assoc($resultado_cargos)) { ?>
                                                    <option value="<?php echo $row_cargos['idPaciente']; ?>"><?php echo $row_cargos['nomePaciente']; ?></option>
                                                <?php } ?> } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Data da Consulta</label>
                                            <input type='date' class="form-control" id='hasta' value='<?php echo date("Y-m-d"); ?>'>
                                        </div>
                                        <div class="fr-view" id="prontuario">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2">
                                                <button type="submit" name="salvarconsulta" id="salvarconsulta" value="salvarconsulta" class="btn btn-success">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="fr-view" id="prontuario_result">
                                    </div>
                                </div>
                            </div>
                            <!-- End Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='./froala-editor\js\languages\pt_br.js'></script>
    <script>
        window.onload = function() {
            return $("#pac").val(<?php echo "$idPaciente"; ?>);
        };
        var editor = new FroalaEditor('#prontuario', {
            language: 'pt_br',
            fileUpload: false,
            videoUpload: false,
            imageUpload: false,
            imageInsertButtons: ['imageByURL'],
            fileInsertButtons: false
        });
        var editor = new FroalaEditor('#prontuario_result', {
            language: 'pt_br',
            fileUpload: false,
            videoUpload: false,
            imageUpload: false,
            imageInsertButtons: ['imageByURL'],
            fileInsertButtons: false
        });
    </script>

    <?php
    include_once "footer.php";
    ?>
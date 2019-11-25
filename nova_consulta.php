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
                                    <form name="consulta" action="salvar_consulta.php" method="post">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nome do Paciente</label>
                                            <input type='text' disabled class="form-control" name="data" value=' <?php
                                                                                                                    $resultado_cargos = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM paciente WHERE idPaciente  = $idPaciente"));
                                                                                                                    echo $resultado_cargos['nomePaciente']; ?>'>
                                        </div>
                                        <input readonly type='hidden' class="form-control" name="pac" value='<?php echo $resultado_cargos['idPaciente']; ?>'>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Data da Consulta</label>
                                            <input type='date' class="form-control" name="data" value='<?php echo date("Y-m-d"); ?>'>
                                        </div>
                                        <textarea name="prontuario" id="prontuario"></textarea>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2">
                                                <button type="submit" name="salvarconsulta" id="salvarconsulta" value="salvarconsulta" class="btn btn-success">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <textarea name="prontuario_result" id="prontuario_result">
                                    <div class="non-editable" contenteditable="false">
                                <?php
                                $result_pront = mysqli_query($con, "SELECT * FROM prontuario WHERE idPaciente = $idPaciente ORDER BY idProntuario DESC");
                                while ($prontuarios = mysqli_fetch_array($result_pront)) { ?>
                                    <hr>
                                    <p align='center'><strong><font size='3' color='red'>
                                        <?php echo date("d/m/Y", strtotime($prontuarios['dtProntuario'])); ?>
                                    </font></strong></p>
                                    <hr>
                                    <?php echo "$prontuarios[prontuario]";
                                    } ?>
                                </div>
                                </textarea>
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
            fileInsertButtons: false,
            toolbarInline: false,
            placeholderText: 'Digite as informações da consulta...'
        });
        var editor = new FroalaEditor('#prontuario_result', {
            language: 'pt_br',
            fileUpload: false,
            videoUpload: false,
            imageUpload: false,
            imageInsertButtons: ['imageByURL'],
            fileInsertButtons: false,
            toolbarInline: false
        });
    </script>

    <?php
    include_once "footer.php";
    ?>
<?php
include_once "dao/conexao.php";
include_once "header.php";
$idPaciente = $_GET['pacID'];
?>

<style>
    #logo {
        display: none;
    }
</style>

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
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Histórico de Consultas</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
        var editor = new FroalaEditor('#prontuario_result', {
            language: 'pt_br',
            fileUpload: false,
            videoUpload: false,
            imageUpload: false,
            imageInsertButtons: ['imageByURL'],
            fileInsertButtons: false,
            toolbarInline: false,
            placeholderText: 'Nenhum prontuário cadastrado.'
        });
    </script>

    <?php
    include_once "footer.php";
    ?>
<?php
include_once "dao/conexao.php";
include_once "header.php";
if ($_SESSION['idCargo']  != 3 && $_SESSION['idCargo'] != 2) {
    echo "<script>alert('Você não tem acesso ao Agendamento de Consultas!');window.location='index.php'</script>";
}

mysqli_query($con, "SET NAMES utf8");
$result_events = "SELECT idMedico,idConsulta,consulta.idPaciente,consulta.tipoConsulta,paciente.nomePaciente,paciente.idPaciente, start, end FROM consulta,paciente WHERE consulta.idPaciente = paciente.idPaciente";
$resultado_events = mysqli_query($con, $result_events);

$result_medicos = "SELECT idFuncionario,nomeFuncionario,idCargo FROM funcionario WHERE idCargo = 3";
$resultado_medicos = mysqli_query($con, $result_medicos);
?>

<link href='fullcalendar/core/main.css' rel='stylesheet' />
<link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
<link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
<link href='fullcalendar/bootstrap/main.css' rel='stylesheet' />
<link rel="stylesheet" href="css/select2.min.css" />
<link rel="stylesheet" href="css/select2-bootstrap.min.css" />

<script src='fullcalendar/core/main.js'></script>
<script src='fullcalendar/interaction/main.js'></script>
<script src='fullcalendar/daygrid/main.js'></script>
<script src='fullcalendar/timegrid/main.js'></script>
<script src='fullcalendar/resource-common/main.js'></script>
<script src='fullcalendar/resource-daygrid/main.js'></script>
<script src='fullcalendar/resource-timegrid/main.js'></script>
<script src='fullcalendar/bootstrap/main.js'></script>
<script src='fullcalendar/moment/main.js'></script>
<script src='fullcalendar/core/locales/pt-br.js'></script>
<script src="jquery/jquery.min.js"></script>
<script src="js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            plugins: ['interaction', 'resourceDayGrid', 'resourceTimeGrid'],
            selectable: true,
            allDayDefault: false,
            forceEventDuration: true,
            defaultTimedEventDuration: '00:30:00',
            defaultView: 'resourceTimeGridDay',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'resourceTimeGridDay,resourceTimeGridTwoDay,timeGridWeek,dayGridMonth'
            },
            contentHeight: "auto",
            views: {
                resourceTimeGridTwoDay: {
                    type: 'resourceTimeGrid',
                    duration: {
                        days: 2
                    },
                    buttonText: '2 dias',
                }
            },
            extraParams: function() {
                return {
                    cachebuster: new Date().valueOf()
                };
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // don't let the browser navigate
                console.log(info);
                $('#visualizar #med_nome').val(info.getResources);
                $('#visualizar #pac_nome').val(info.event.title);
                //$('#visualizar #medIdE').val(info.resource.id);
                $('#visualizar #consultaID').val(info.event.id);
                $('#visualizar #tipoC').val(info.event.backgroundColor);
                $('#visualizar #start_c').val(info.event.start.toLocaleString());
                $('#visualizar #end_c').val(info.event.end.toLocaleString());
                $('#visualizar').modal('show');
            },
            select: function(info) {
                $('#cadastrar #start').val(info.start.toLocaleString());
                $('#cadastrar #end').val(info.end.toLocaleString());
                $('#cadastrar #med').val(info.resource.title);
                $('#cadastrar #medId').val(info.resource.id);
                $('#cadastrar').modal('show');
            },
            minTime: '08:00:00',
            maxTime: '18:00:00',
            slotDuration: '00:30:00',
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                omitZeroMinute: false,
                meridiem: 'short'
            },
            slotLabelInterval: '00:30:00',
            nowIndicator: true,
            events: 'listar_consultas.php',
            //// uncomment this line to hide the all-day slot
            allDaySlot: false,

            resources: 'listar_medicos.php',
        });

        calendar.render();
        calendar.setOption('locale', 'pt-br');
    });

    //Mascara para o campo data e hora
    function DataHora(evento, objeto) {
        var keypress = (window.event) ? event.keyCode : evento.which;
        campo = eval(objeto);
        if (campo.value == '00/00/0000 00:00:00') {
            campo.value = "";
        }

        caracteres = '0123456789';
        separacao1 = '/';
        separacao2 = ' ';
        separacao3 = ':';
        conjunto1 = 2;
        conjunto2 = 5;
        conjunto3 = 10;
        conjunto4 = 13;
        conjunto5 = 16;
        if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
            if (campo.value.length == conjunto1)
                campo.value = campo.value + separacao1;
            else if (campo.value.length == conjunto2)
                campo.value = campo.value + separacao1;
            else if (campo.value.length == conjunto3)
                campo.value = campo.value + separacao2;
            else if (campo.value.length == conjunto4)
                campo.value = campo.value + separacao3;
            else if (campo.value.length == conjunto5)
                campo.value = campo.value + separacao3;
        } else {
            event.returnValue = false;
        }
    }
</script>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Start Content -->
                            <div class="card-title">Consultas</div>
                        </div>
                        <div id="calendar" class="has-toolbar"></div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cad Modal-->
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Agendar Consulta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <span id="msg-cad"></span>
                    <form class="form-horizontal" form id="addconsulta" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dr(a).</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="med" id="med" disabled>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="medId" id="medId" readonly>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Paciente</label>
                            <div class="col-sm-10">
                                <select name="pac" id="pac" class="form-control" style="width: 100%">
                                    <option></option>
                                    <?php
                                    $resultado_cargos = mysqli_query($con, "SELECT * FROM paciente");
                                    while ($row_cargos = mysqli_fetch_assoc($resultado_cargos)) { ?>
                                        <option value="<?php echo $row_cargos['idPaciente']; ?>"><?php echo $row_cargos['nomePaciente']; ?></option>
                                    <?php } ?> } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
                            <div class="col-sm-10">
                                <select name="tipo" class="form-control" id="tipo">
                                    <option value="">Selecione</option>
                                    <option style="color:#228B22;" value="#228B22">Consulta</option>
                                    <option style="color:#8B0000;" value="#8B0000">Urgência</option>
                                    <option style="color:#436EEE;" value="#436EEE">Retorno</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="start" id="start" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="end" id="end" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="add_consulta" id="add_consulta" value="addconsulta" class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal -->
    <!-- Ver Modal-->
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" form id="editconsulta" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dr(a).</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="med_nome" id="med_nome" disabled>
                            </div>
                        </div>

                        <input type="text" class="form-control" name="medIdE" id="medIdE" readonly>

                        <input type="text" class="form-control" name="consutaID" id="consultaID" readonly>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Paciente</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pac_nome" id="pac_nome" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
                            <div class="col-sm-10">
                                <select name="tipo" class="form-control" id="tipoC">
                                    <option value="">Selecione</option>
                                    <option style="color:#228B22;" value="#228B22">Consulta</option>
                                    <option style="color:#8B0000;" value="#8B0000">Urgência</option>
                                    <option style="color:#436EEE;" value="#436EEE">Retorno</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="start_c" id="start_c" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="end_c" id="end_c" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="edit_consulta" id="edit_consulta" value="editconsulta" class="btn btn-success">Remarcar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal -->
</div>
</section>
</aside>
<script>
    $("#pac").select2({
        placeholder: "Selecione um Paciente",
        allowClear: true,
        theme: "bootstrap"
    });
</script>
<script>
    $(document).ready(function() {
        $("#addconsulta").on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "proc_agendamento.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(retorna) {
                    if (retorna['sit']) {
                        $("#msg-cad").html(retorna['msg']);
                        location.reload();
                    } else {
                        $("#msg-cad").html(retorna['msg']);
                    }
                }
            })
        });
    });
</script>
<?php
include_once "footer.php";
?>
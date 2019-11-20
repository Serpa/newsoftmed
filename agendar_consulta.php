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
            selectAllow: function(info) {
                if (info.start.isBefore(moment()))
                    return false;
                return true;
            },
            defaultView: 'resourceTimeGridDay',
            locale: 'pt-br',
            timeZone: 'America/Sao_Paulo',
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
            dateClick: function(info) {
                //alert('clicked ' + info.dateStr + ' on resource ' + info.resource.id);
                $('#cadastrar #start').val(info.dateStr);
                $('#cadastrar #end').val(info.dateStr + '00:30:00');
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
            events: [
                <?php
                while ($row_events = mysqli_fetch_array($resultado_events)) {
                    ?> {
                        resourceId: '<?php echo $row_events['idMedico']; ?>',
                        id: '<?php echo $row_events['idConsulta']; ?>',
                        color: '<?php echo $row_events['tipoConsulta']; ?>',
                        title: '<?php echo $row_events['nomePaciente']; ?>',
                        start: '<?php echo $row_events['start']; ?>',
                        end: '<?php echo $row_events['end']; ?>'
                    },
                <?php
                }
                ?>
            ],

            //// uncomment this line to hide the all-day slot
            //allDaySlot: false,

            resources: [
                <?php
                while ($row_medicos = mysqli_fetch_array($resultado_medicos)) {
                    ?> {
                        id: '<?php echo $row_medicos['idFuncionario']; ?>',
                        title: '<?php echo $row_medicos['nomeFuncionario']; ?>'
                    },
                <?php
                }
                ?>
            ],
        });

        calendar.render();
        calendar.setOption('locale', 'pt-br');
    });

    //Mascara para o campo data e hora
    /*    function DataHora(evento, objeto) {
            var keypress = (window.event) ? event.keyCode : evento.which;
            campo = eval(objeto);
            if (campo.value == '00/00/0000 00:00:00') {
                campo.value = ""
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
        }*/
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
    <!-- Edit Modal-->
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">                    
                    <h4 class="modal-title text-center">Agendar Consulta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="proc_cad_evento.php">

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
                                        <option value="<?php echo utf8_encode($row_cargos['idPaciente']); ?>"><?php echo $row_cargos['nomePaciente']; ?></option>
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
                                <input type="datetime-local" class="form-control" name="start" id="start">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
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
<?php
include_once "footer.php";
?>
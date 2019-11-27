<?php
include_once "dao/conexao.php";
include_once "header.php";
if ($_SESSION['idCargo']  != 3 && $_SESSION['idCargo'] != 2) {
    echo "<script>alert('Você não tem acesso ao Agendamento de Consultas!');window.location='index.php'</script>";
}

mysqli_query($con, "SET NAMES utf8");
if ($_SESSION['idCargo']  == 3) {
    $result_events = "SELECT idMedico,idConsulta,consulta.idPaciente,consulta.tipoConsulta,paciente.nomePaciente,paciente.idPaciente, start, end FROM consulta,paciente WHERE consulta.idPaciente = paciente.idPaciente AND consulta.idMedico = $_SESSION[idFuncionario] ";
} else {
    $result_events = "SELECT idMedico,idConsulta,consulta.idPaciente,consulta.tipoConsulta,paciente.nomePaciente,paciente.idPaciente, start, end FROM consulta,paciente WHERE consulta.idPaciente = paciente.idPaciente";
}

$resultado_events = mysqli_query($con, $result_events);

$result_medicos = "SELECT idFuncionario,nomeFuncionario,idCargo FROM funcionario WHERE idFuncionario = $_SESSION[idFuncionario]";
$resultado_medicos = mysqli_query($con, $result_medicos);
?>

<style>
    .fc-title {
        font-weight: bold;
    }
</style>
<link href='fullcalendar/core/main.css' rel='stylesheet' />
<link href='fullcalendar/list/main.css' rel='stylesheet' />
<link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
<link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
<link href='fullcalendar/bootstrap/main.css' rel='stylesheet' />

<script src='fullcalendar/core/main.js'></script>
<script src='fullcalendar/list/main.js'></script>
<script src='fullcalendar/interaction/main.js'></script>
<script src='fullcalendar/daygrid/main.js'></script>
<script src='fullcalendar/timegrid/main.js'></script>
<script src='fullcalendar/resource-common/main.js'></script>
<script src='fullcalendar/resource-daygrid/main.js'></script>
<script src='fullcalendar/resource-timegrid/main.js'></script>
<script src='fullcalendar/bootstrap/main.js'></script>
<script src='fullcalendar/moment/main.js'></script>
<script src='fullcalendar/core/locales/pt-br.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['list', 'interaction'],
            defaultView: 'listWeek',
            selectable: true,
            // customize the button names,
            // otherwise they'd all just say "list"
            views: {
                listDay: {
                    buttonText: 'listar dia'
                },
                listWeek: {
                    buttonText: 'listar semana'
                },
                listMonth: {
                    buttonText: 'listar mês'
                }
            },

            header: {
                left: 'title',
                center: '',
                right: 'listDay,listWeek,listMonth'
            },
            eventRender: function(event, element, view) {
                console.log(event);
                $(element).find(".fc-list-item-title").append("<div>" + event.resourceId + "</div>");
            },
            events: [
                <?php
                while ($row_events = mysqli_fetch_array($resultado_events)) {
                    ?> {
                        resourceId: '<?php echo $row_events['idMedico']; ?>',
                        id: '<?php echo $row_events['idConsulta']; ?>',
                        idPaciente: '<?php echo $row_events['idPaciente']; ?>',
                        color: '<?php echo $row_events['tipoConsulta']; ?>',
                        title: '<?php echo $row_events['nomePaciente']; ?>',
                        start: '<?php echo $row_events['start']; ?>',
                        end: '<?php echo $row_events['end']; ?>'
                    },
                <?php
                }
                ?>
            ]
        });

        calendar.render();
        calendar.setOption('locale', 'pt-br');
    });
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
    </section>
    </aside>
    <?php
    include_once "footer.php";
    ?>
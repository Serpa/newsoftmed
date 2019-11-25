<?php
include_once "dao/conexao.php";

$query_events = "SELECT idMedico,idConsulta,consulta.idPaciente,consulta.tipoConsulta,paciente.nomePaciente,paciente.idPaciente, start, end FROM consulta,paciente WHERE consulta.idPaciente = paciente.idPaciente";
$resultado_events =mysqli_query($con,$query_events);

$eventos = [];

while($row_events = mysqli_fetch_array($resultado_events)){
    $resourceId = $row_events['idMedico'];
    $id = $row_events['idConsulta'];
    $color = $row_events['tipoConsulta'];
    $title = $row_events['nomePaciente'];
    $start = $row_events['start'];
    $end = $row_events['end'];
    $textColor = 'white';
    $borderColor = 'yellow';

    $eventos[] = [
        'id' => $id,
        'resourceId' => $resourceId, 
        'title' => $title, 
        'color' => $color, 
        'start' => $start, 
        'end' => $end,
        'textColor' => $textColor,
        'borderColor' => $borderColor, 
        ];
}

echo json_encode($eventos);

//print_r ($eventos);
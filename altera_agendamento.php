<?php
include_once "dao/conexao.php";
session_start();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['start_c']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['end_c']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$query_event = "UPDATE consulta SET tipoConsulta = :tipoC, start = :start_c, end = :end_c WHERE idConsulta = :consultaID";


$insert_event = $conn->prepare($query_event);
$insert_event->bindParam(':tipoC', $dados['tipoC']);
$insert_event->bindParam(':consultaID', $dados['consultaID']);
$insert_event->bindParam(':start_c', $data_start_conv);
$insert_event->bindParam(':end_c', $data_end_conv);

if ($insert_event->execute()) {
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Consulta remarcada com sucesso!</div>'];
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Consulta remarcada com sucesso!</div>';
} else {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Consulta não foi remarcada com sucesso! Tente novamente!</div>'];
}


header('Content-Type: application/json');
echo json_encode($retorna);

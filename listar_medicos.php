<?php
include_once "dao/conexao.php";

$query_medicos = "SELECT idFuncionario,nomeFuncionario,idCargo FROM funcionario WHERE idCargo = 3";
$resultado_medicos =mysqli_query($con,$query_medicos);

$medicos = [];

while($row_medicos = mysqli_fetch_array($resultado_medicos)){
    $id = $row_medicos['idFuncionario'];
    $title = $row_medicos['nomeFuncionario'];
    
    $medicos[] = [
        'id' => $id,
        'title' => $title,
        ];
}

echo json_encode($medicos);

//print_r ($eventos);
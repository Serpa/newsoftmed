<?php
include_once "dao/conexao.php";

$idPaciente = $_POST['pac'];
$data = $_POST['data'];
$prontuario = $_POST['prontuario'];

$sql = "INSERT INTO prontuario (idPaciente,dtProntuario,prontuario) 
VALUES ('$idPaciente','$data','$prontuario')"; 

if($con->query($sql)=== true){
	echo "<script>alert('Prontuario salvo!');window.location='./index.php'</script>";
	} else {
		echo "Erro para inserir: " . $con->error; 
	}
	$con->close();
	?>
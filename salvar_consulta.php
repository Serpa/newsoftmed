<?php
include_once "dao/conexao.php";

$idPaciente = $_POST['pac'];
$data = $_POST['data'];
$prontuario = $_POST['prontuario'];

echo $idPaciente;
echo $data;
echo $prontuario;

$sql = $con->query("SELECT * FROM prontuario WHERE dtProntuario = '$data'");

if (mysqli_num_rows($sql) > 0) {
	echo "<script>alert('Consulta já realizada no dia de hoje');window.location='./index.php'</script>";
	exit();
} else {
	!$con->query("INSERT INTO prontuario (idPaciente,dtProntuario,prontuario) 
 VALUES ('$idPaciente','$data','$prontuario')");
 echo "<script>alert('Prontuario salvo!');window.location='./index.php'</script>";
}
$con->close();

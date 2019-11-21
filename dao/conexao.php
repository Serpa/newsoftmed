<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "clinicamedica";
$host = "http://localhost/newsoftmed/";

$con = new mysqli($servidor, $usuario, $senha, $banco);

define('HOST', $servidor);
define('USER', $usuario);
define('PASS', $senha);
define('DBNAME', $banco);

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);


if($con->connect_error)
{
	die("Erro de conexao " . $con->connect_error);
}

?>
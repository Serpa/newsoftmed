<?php 

include_once "dao/conexao.php";

$pass = $_POST["pass"];
$idUsuario = $_POST["idUsuario"];
$lostPass = $_POST["lostPass"];

$sql = $con->query("SELECT * FROM usuario WHERE lostPass='$lostPass'");

if(mysqli_num_rows($sql) > 1){
	echo "<script>alert('Error Duplicated lostpass!');window.location='recupera_user.php?lost=".$lostPass."'</script>";
exit();
} else {
 !$con->query("UPDATE usuario SET lostPass = NULL, senha = '$pass'  WHERE idUsuario = $idUsuario");
 echo "<script>alert('Senha alterada com sucesso!');window.location='login.php'</script>";
}
$con->close();

?>
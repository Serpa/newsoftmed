<?php 

include_once "dao/conexao.php";

$id_func = $_POST["id_func"];
$user = $_POST["user"];
$pass = $_POST["pass"];
$idReg = $_POST["idReg"];

$sql = $con->query("SELECT * FROM usuario WHERE user='$user'");

if(mysqli_num_rows($sql) > 0){
	echo "<script>alert('Nome de usuário já cadastrado, por favor escolha outro usuário!');window.location='registro_func.php?reg=".$idReg."'</script>";
exit();
} else {
 !$con->query("INSERT INTO usuario (user,senha,idFuncionario) VALUES ('$user','$pass','$id_func')");
 !$con->query("UPDATE funcionario SET idReg = NULL WHERE idFuncionario = $id_func");
 echo "<script>alert('Cadastro realizado com sucesso!');window.location='login.php'</script>";
}
$con->close();

?>
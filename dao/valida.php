<?php
		include_once "conexao.php";

		session_start();
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE user = '$usuario' and senha='$senha' ";

	$res = $con->query($sql);
	$linha = $res->fetch_assoc();

$idFuncionario = $linha['idFuncionario'];
$user = $linha['user'];
$senha_db = $linha['senha'];

$nomesql = mysqli_query ($con,"SELECT funcionario.nomeFuncionario,funcionario.idFuncionario,usuario.idFuncionario FROM usuario,funcionario WHERE funcionario.idFuncionario = '$idFuncionario'");

	$result = mysqli_fetch_array($nomesql);
	$nomeUser = $result['nomeFuncionario'];

	$cargosql = mysqli_query ($con,"SELECT funcionario.idCargo,cargo.descricao,cargo.idCargo,funcionario.nomeFuncionario,funcionario.email from funcionario,cargo where funcionario.idCargo = cargo.idCargo and funcionario.nomeFuncionario = '$nomeUser'");

	$result2 = mysqli_fetch_array($cargosql);
	$cargoUser = $result2['idCargo'];
	$cargoNome = $result2['descricao'];
	$email = $result2['email'];

if(!empty($usuario) || !empty($senha)){
if ($usuario == $user  && $senha == $senha_db)
{
	$_SESSION['login'] = true;
    $_SESSION['idFuncionario'] = $idFuncionario;
	$_SESSION['user'] = $user;
	$_SESSION['nomeFuncionario'] = $nomeUser;
	$_SESSION['idCargo'] = $cargoUser;
	$_SESSION['descricao'] = $cargoNome;
	$_SESSION['email'] = $email;

	header('location: ../index.php'); 
}

else{
	echo "<script>alert('Usuário e/ou senha inválidos.');window.location='../login.php'</script>";
}
}else{
	echo "<script>alert('Usuário e/ou senha inválidos.');window.location='../login.php'</script>";
}

?>
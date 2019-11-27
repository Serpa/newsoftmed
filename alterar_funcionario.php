<?php

include_once "dao/conexao.php";

$idFuncionario = $_POST["idFuncionario"];
$nome = $_POST["nomeFuncionario"];
$rg = $_POST["rg"];
$cpf = $_POST["cpf"];
$dtNascimento = $_POST["dtNascimento"];
$dtAdmissao = $_POST["dtAdmissao"];
$dtDesligamento = $_POST["dtDesligamento"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cep = $_POST["cep"];
$tel = $_POST["telefone"];
$cel = $_POST["celular"];
$email = $_POST["email"];
$idCargo = $_POST["cargos"];


$sql = "UPDATE  funcionario SET nomeFuncionario = '$nome', rg = '$rg', cpf = '$cpf', dtNascimento = '$dtNascimento', 
dtAdmissao = '$dtAdmissao', dtDesligamento = '$dtDesligamento', rua = '$rua' , numero = '$numero',
bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep' , telefone = '$tel' , celular = '$cel', email = '$email', idCargo = '$idCargo' where idFuncionario ='$idFuncionario' "; 



if($con->query($sql)=== true){
echo "<script>alert('Cadastro alterado com sucesso!');window.location='index.php'</script>";
} else {
	echo "Erro para inserir: " . $con->error; 
}
$con->close();
?>
<?php

include_once "dao/conexao.php";

$idPaciente = $_POST["idPaciente"];
$nomePaciente = $_POST["nomePaciente"];
$rg = $_POST["rg"];
$cpf = $_POST["cpf"];
$dtNascimento = $_POST["dtNascimento"];
$mae = $_POST["mae"];
$pai = $_POST["pai"];
$cep = $_POST["cep"];
$estado = $_POST["estado"];
$cidade = $_POST["cidade"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$tel = $_POST["telefone"];
$cel = $_POST["celular"];
$email = $_POST["email"];
$tipoSanguineo = $_POST["tipoSanguineo"];
$altura = $_POST["altura"];
$peso = $_POST["peso"];


$sql = "UPDATE  paciente SET nomePaciente = '$nomePaciente', rg = '$rg', cpf = '$cpf', dtNascimento = '$dtNascimento', 
nomeMae = '$mae', nomePai = '$pai', cep = '$cep' , estado = '$estado',
cidade = '$cidade', rua = '$rua', numero = '$numero', bairro = '$bairro' , telefone = '$tel' , celular = '$cel', email = '$email', tipoSanguineo = '$tipoSanguineo',altura = '$altura',peso = '$peso' where idPaciente ='$idPaciente' "; 



if($con->query($sql)=== true){
echo "<script>alert('Cadastro alterado com sucesso!');window.location='consultar_paciente.php'</script>";
} else {
	echo "Erro para inserir: " . $con->error; 
}
$con->close();
?>
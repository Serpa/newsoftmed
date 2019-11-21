<?php

require 'PHPMailer/PHPMailerAutoload.php';
include_once "dao/conexao.php";

$nome = $_POST["nome"];
$rg = $_POST["rg"];
$cpf = $_POST["cpf"];
$dtNascimento = $_POST["dtnascimento"];
$nomeMae = $_POST["nomeMae"];
$nomePai = $_POST["nomePai"];
$rua = $_POST["rua"];
$numero = $_POST["num"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cep = $_POST["cep"];
$tel = $_POST["tel"];
$cel = $_POST["cel"];
$email = $_POST["email"];
$tipoSanguineo = $_POST["tipoSanguineo"];
$altura = $_POST["altura"];
$peso = $_POST["peso"];

$sql = $con->query("SELECT * FROM paciente WHERE nomePaciente='$nome'");

if (mysqli_num_rows($sql) > 0) {
	echo "<script>alert('Paciente já cadastrado! Cadastre um novo Paciente');window.location='CadastrarPaciente.php'</script>";
	exit();
} else {
	!$con->query("INSERT INTO paciente (nomePaciente,cpf,rg,dtNascimento,nomeMae,nomePai,rua,numero,bairro,cidade,estado,cep,telefone,celular,email,tipoSanguineo,peso,altura) 
 VALUES ('$nome','$cpf','$rg','$dtNascimento','$nomeMae','$nomePai','$rua','$numero','$bairro','$cidade','$estado','$cep','$tel','$cel','$email','$tipoSanguineo','$peso','$altura')");
	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.gmail.com"; // Servidor SMTP
	$mail->SMTPSecure = "tls"; // conexão segura com TLS
	$mail->Port = 587;
	$mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
	$mail->Username = "softmeduemg@gmail.com"; // SMTP username
	$mail->Password = "123456soft"; // SMTP password

	$mail->setFrom('softmeduemg@gmail.com', 'SoftMed!');
	$mail->addAddress($email, $nome);     // Add a recipient
	$mail->isHTML(true);

	$mail->Subject = 'Bem-Vindo ao grupo SoftMed!';
	$mail->Body    = '<p>Ol&aacute;, ' . $nome . '</p>
 	<p>Seja bem-vindo ao grupo SoftMed!</p>
	<p>Agora que voc&ecirc; est&aacute; cadastrado, voc&ecirc; recebera notifica&ccedil;&otilde;es sobre suas consultas por esse e-mail.</p>
	<p>Sempre que uma consulta agendada estiver pr&oacute;xima, voc&ecirc; recebera um e-mail para confirma&ccedil;&atilde;o de consulta, ressaltamos a import&acirc;ncia da confirma&ccedil;&atilde;o da consulta, uma vez que, sem a confirma&ccedil;&atilde;o, sua vaga n&atilde;o est&aacute; assegurada.</p>
	<p>Atenciosamente,</p>
	<p>Grupo SoftMed!</p>';
	if (!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo "<script>alert('Cadastro realizado com sucesso!');window.location='CadastrarPaciente.php'</script>";
	}
}
$con->close();

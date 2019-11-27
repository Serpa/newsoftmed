<?php 

require 'PHPMailer/PHPMailerAutoload.php';
include_once "dao/conexao.php";

$nome = $_POST["nome"];
$rg = $_POST["rg"];
$cpf = $_POST["cpf"];
$dtNascimento = $_POST["dtnascimento"];
$dtAdmissao = $_POST["dtadmissao"];
$rua = $_POST["rua"];
$numero = $_POST["num"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cep = $_POST["cep"];
$tel = $_POST["tel"];
$cel = $_POST["cel"];
$email = $_POST["email"];
$idcargo = $_POST["cargos"];
$idReg = uniqid(rand(), true); 

$sql = $con->query("SELECT * FROM funcionario WHERE nomeFuncionario='$nome'");

if(mysqli_num_rows($sql) > 0){
	echo "<script>alert('Funcionário já cadastrado! Cadastre um novo funcionário');window.location='consultar_funcionario.php'</script>";
exit();
} else {
 !$con->query("INSERT INTO funcionario (nomeFuncionario,rg,cpf,dtNascimento,dtAdmissao,rua,numero,bairro,cidade,estado,cep,telefone,celular,email,idCargo,idReg) 
 VALUES ('$nome','$rg','$cpf','$dtNascimento','$dtAdmissao','$rua','$numero','$bairro','$cidade','$estado','$cep','$tel','$cel','$email','$idcargo','$idReg')");
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
 
 $mail->Subject = 'Bem-Vindo ao quadro de funcionários!';
 $mail->Body    = '<p>Olá, '.$nome.'</p>
 <p>Seja bem-vindo ao quadro de funcionários da SoftMed!</p>
 <p>Agora que você está conosco nessa jornada, será necessario realizar o cadastro para usar o nosso sistema, para isso acesse o link abaixo:</p>
 <p>'.$host.'registro_func.php?reg='.$idReg.'</p>';
 if(!$mail->send()) {
	 echo 'Message could not be sent.';
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
 } else {
	echo "<script>alert('Cadastro realizado com sucesso!');window.location='consultar_funcionario.php'</script>";
 }
}
$con->close();

?>
<?php 

require 'PHPMailer/PHPMailerAutoload.php';
include_once "dao/conexao.php";

$email = $_POST["email"];
$lostPass = uniqid(rand(), true); 
$sql_email = "SELECT * FROM funcionario,usuario WHERE email = '$email' AND funcionario.idFuncionario = usuario.idFuncionario";
$sql = mysqli_query($con,$sql_email);
if(mysqli_num_rows($sql) == 0){
    echo "<script>alert('Não há nenhum funcionário cadastrado com o e-mail informado ou você ainda não realizou o cadastro, por favor verifique seu e-mail!');window.location='login.php'</script>";
exit();
} else {
    $result_lost = mysqli_fetch_array($sql);
    $id_func = $result_lost['idFuncionario'];
    $nome = $result_lost['nomeFuncionario'];
    echo $id_func;
 !$con->query("UPDATE usuario SET lostPass = '$lostPass'  WHERE idFuncionario = $id_func");
} $mail = new PHPMailer;

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

$mail->Subject = 'Recuperação de Senha SoftMed';
$mail->Body    = '<p>Olá, '.$nome.'</p>
<p>Para recuperar o acesso ao sistema, por favor acesse o link abaixo:</p>
<p>'.$host.'recuperar_user.php?lost='.$lostPass.'</p>';
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo "<script>alert('E-mail enviado com sucesso!');window.location='./login.php'</script>";
}
$con->close();

?>
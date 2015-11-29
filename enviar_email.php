<?php

session_start();
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nomeremetente     = $_POST['nome'];
$emailremetente    = trim($_POST['email']);
$emaildestinatario = 'rodolforuffer@yahoo.com.br'; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
$assunto           = $_POST['assunto'];
$mensagem          = $_POST['text'];
$telefone          = "teste";
 
if($nomeremetente == null){
    echo "<script>alert('O campo nome não foi preenchido!');history.back();</script>";
}else if($emailremetente == null){
    echo "<script>alert('O campo email não foi preenchido!');history.back();</script>";
}else if($assunto == null){
    echo "<script>alert('O campo assunto não foi preenchido!');history.back();</script>";
}else if($mensagem == null){
    echo "<script>alert('O campo mensagem não foi preenchido!');history.back();</script>";
}else{ 
    
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P>FORMULARIO PREENCHIDO NO SITE WWW.TCCMINERACAODEDADOS.COM.</P>
<p><b>Nome:</b> '.$nomeremetente.'</p>
<p><b>E-Mail:</b> '.$emailremetente.'</p>
<p><b>Telefone:</b> '.$telefone.'</p>
<p><b>Assunto:</b> '.$assunto.'</p>
<p><b>Mensagem:</b> '.$mensagem.'</p>
<hr>';


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $emailremetente\r\n"; // remetente
$headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);
 
// Página que será redirecionada
if($envio){
    echo "<script>alert('Enviado com sucesso!');history.back();</script>"; 
}else{
    echo "<script>alert('Erro no envio, Favor entrar em contato pelas redes sociais!');history.back();</script>"; 

}
    
}
?>
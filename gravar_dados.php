<?php

date_default_timezone_set('UTC');

session_start();

//Database connection
$m = new MongoClient();
$db = $m->db;
$collection = $db->dados_usuarios;

$id_face = $_SESSION['id'];
$sexo = $_POST['sexo'];
$amigos = $_SESSION['fb_amigos'];
$link_perfil = $_SESSION['link_perfil'];
$email = trim($_POST['email']);
$nome = $_POST['nome'];
$cep = str_replace('-', '', $_POST['cep']);
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$ibge = $_POST['ibge'];
$dataNascimento = $_POST['data_nascimento'];

//testes
if($nome == null){
    echo "<script>alert('O campo NOME não foi preenchido!');history.back();</script>";
}else if($sexo == null){
    echo "<script>alert('O campo SEXO não foi preenchido!');history.back();</script>";
}else if($dataNascimento == null){
    echo "<script>alert('O campo DATA DE NASCIMENTO não foi preenchido!');history.back();</script>";
}else if($email == null){
    echo "<script>alert('O campo EMAIL não foi preenchido!');history.back();</script>";
}else if($cep == null){
    echo "<script>alert('O campo CEP não foi preenchido!');history.back();</script>";
}else if($rua == null){
    echo "<script>alert('O campo RUA não foi preenchido!');history.back();</script>";
}else if($bairro == null){
    echo "<script>alert('O campo BAIRRO não foi preenchido!');history.back();</script>";
}else if($cidade == null){
    echo "<script>alert('O campo CIDADE não foi preenchido!');history.back();</script>";
}else if($uf == null){
    echo "<script>alert('O campo UF não foi preenchido!');history.back();</script>";
}else{ 
    
// Separa em dia, mês e ano
list($dia, $mes, $ano) = explode('/', $dataNascimento);
    
// Descobre que dia é hoje e retorna a unix timestamp
$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
// Descobre a unix timestamp da data de nascimento do fulano
$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
// Depois apenas fazemos o cálculo já citado :)
$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

$timestamp = mktime(date("H")-3, date("i"), date("s"), date("m"), date("d"), date("Y"));
$data_registro = gmdate("d/m/Y H:i:s", $timestamp);

//gravar dados no banco
$document = array("Id_face"         => $id_face,
                  "Nome"            => $nome,
                  "Sexo"            => $sexo,
                  "Data_nascimento" => $dataNascimento,
                  "Idade"           => $idade,
                  "Email"           => $email,
                  "Cep"             => $cep,
                  "Rua"             => $rua,
                  "Bairro"          => $bairro,
                  "Cidade"          => $cidade,
                  "uf"              => $uf,
                  "Ibge"            => $ibge,
                  "Link_face"       => $link_perfil,
                  "Amigos"          => $amigos,
                  "Data_registro"   => $data_registro);

$collection->insert($document);

$_SESSION['logout'] = $id_face;
                
//$m.close();

header("Refresh: 0;url=index.php?msg=1");
    
}

?>
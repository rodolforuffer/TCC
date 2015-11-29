<?php 

session_start();

    //Faz a conexão com o banco de dados
	$mongo = new Mongo();

    //seleciona o banco db
	$db = $mongo->selectDB("db");

    //faz um select na coleção dados_usuarios
	$c_usuarios = $mongo->selectCollection($db,"dados_usuarios");
?>
<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');

	if(isset($_POST['conversar'])){
		$_SESSION['id_destino']=$_POST['id_destino'];
		$array1=array($_SESSION['id_usuario'], $_SESSION['id_destino']);
	}

	if(isset($_GET['info'])){
		$_SESSION['id_destino']=$_GET['id_destino'];
		$array1=array($_SESSION['id_usuario'], $_SESSION['id_destino']);
	}

	$_SESSION['registro_conversa1']=implode("-", $array1);
		$array2=array($_SESSION['id_destino'], $_SESSION['id_usuario']);
	$_SESSION['registro_conversa2']=implode("-", $array2);
	echo('<script>window.location="chat.php";</script>');
?>
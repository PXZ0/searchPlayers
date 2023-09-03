<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');

	if(isset($_POST['conversar_time'])){
		$_SESSION['id_time']=$_POST['id_time'];
	}
	echo('<script>window.location="chat_time.php";</script>');
?>


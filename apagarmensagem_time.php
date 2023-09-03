<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');

	$id_mensagem=filter_input(INPUT_GET, 'id_mensagem', FILTER_SANITIZE_NUMBER_INT);

	$apagar_mensagem='delete from chat_time where id_mensagem="'.$id_mensagem.'";';

	$consulta=mysqli_query($conexao, $apagar_mensagem);
	
	echo('<script>window.location="chat_time.php";</script>');
?>
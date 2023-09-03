<?php
	include('conexao.php');
	session_start();

	$sqlbu='select * from notifica where id_para='.$_SESSION['id_usuario'].' order by id_usu desc;';

	$resul=mysqli_query($conexao, $sqlbu);

	$linhas=mysqli_num_rows($resul);

	if($linhas > 0){

		while($con=mysqli_fetch_array($resul)){
			echo('<a class="dropdown-item" href="'.$con['link'].'">'.$con['notifi'].'</a>');
		}
	}else{
		echo('<span class="dropdown-item">Sem Notificações</span>');
	}
?>
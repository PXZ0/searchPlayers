<?php
	if(isset($_POST['sim'])){
?>
	<form name='excluir' action="#" method="POST">
			Deseja mesmo sair do time? Seu técnico será notificado e você será notificado por isso!
			<section class="botoes">
				<input class="btn btn-success" type="submit" name="sim" value="Sim">
				<input class="btn btn-danger" type="submit" name="nao" value="Não">
			</section>
	</form>
<?php
	if(isset($_POST['sim'])) {
		$sqlex= 'delete from jogadores_time where id_jogador ="'.$_SESSION['id_usuario'].'" and id_time="'.$cons2['id_esporte'];.'";';

		$excluir=mysqli_query($conexao, $sqlex);

		if($excluir){
			echo('<script>window.alert("Saída realizada com sucesso!"); window.location="deslogar.php"; </script>');
		}else{
			echo('<script>window.alert("Saída não realizada! Tente Novamente"); </script>');
		}
	}
	if(isset($_POST['nao'])){
		header('location:meus_times.php');
	}
?>
<link rel="stylesheet" href="./css/style_meutime.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
<?php
	switch($tipo_chat){
		case 1:
		$dados_usuario='select * from usuario where id_usuario="'.$_SESSION['id_destino'].'";';
		$consulta=mysqli_query($conexao, $dados_usuario);
		$con=mysqli_fetch_array($consulta);
		if(mysqli_num_rows($consulta)){
?>
	<section class="d-flex align-items-center flex-column">
		<div class="mx-auto" style="width: 350px;">
			<img class="sem_mensagem" style="width: 350px;" src="./img/sem_mensagem">
		</div>
		<p class="text-center text_mensagem">
			<?php
				switch($_SESSION['sexo']){
					case 1:
						echo('Parece que '.ucwords($con['nome']).' não enviou uma mensagem para você ainda, seja o primeiro!');
					break;
					case 2:
						echo('Parece que '.ucwords($con['nome']).' não enviou uma mensagem para você ainda, seja a primeira!');
					break;
					default:
						echo('Parece que '.ucwords($con['nome']).' não enviou uma mensagem para você ainda, seja x primeirx!');
					break;
				}
			?>
		</p>
	</section>	
<?php
		}
		break;
		case 2:
		$sqlbu='select * from times where id_time="'.$_SESSION['id_time'].'";';

		$resul=mysqli_query($conexao, $sqlbu);

		$consulta=mysqli_fetch_array($resul);

		if(mysqli_num_rows($resul)){
?>
	<section class="d-flex align-items-center flex-column">
		<div class="mx-auto" style="width: 350px;">
			<img class="sem_mensagem" style="width: 350px;" src="./img/sem_mensagem">
		</div>
		<p class="text-center text_mensagem ">
			<?php
				switch($_SESSION['sexo']){
					case 1:
						echo('Parece que ninguém do '.$consulta['nome'].' enviou uma mensagem ainda, seja o primeiro!');
					break;
					case 2:
						echo('Parece que ninguém do '.$consulta['nome'].' enviou uma mensagem ainda, seja a primeira!');
					break;
					default:
						echo('Parece que ninguém do '.$consulta['nome'].' enviou uma mensagem ainda, seja x primeirx!');
					break;
				}
			?>
		</p>
	</section>

<?php
		}
		break;
	}
?>
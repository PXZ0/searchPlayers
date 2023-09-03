<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Styles -->
		<link rel="stylesheet" href="./css/style_header.css">
		<link rel="stylesheet" href="./css/style_footer.css">
		<link rel="stylesheet" href="./css/style_home.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Exclusão de Conta da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>

	<body>
		<!-- Cabeçalho -->
		<?php
			include('header.php');
		?>

		<main>
			<?php
				if(isset($_GET['id_analista'])){
					$id_analisador=$_GET['id_analista'];
					$id_partida=$_GET['id_partida'];

					$id_partida=$_GET['id_partida'];

					$sqlbu='select * from partidas where id_partida='.$id_partida.';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con=mysqli_fetch_array($resul);


					if($resul){

						$sqlbu='select * from times where id_time='.$con['id_time1'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time1=mysqli_fetch_array($resul);


						$sqlbu='select * from times where id_time='.$con['id_time2'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time2=mysqli_fetch_array($resul);

						$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_meu_time=mysqli_fetch_array($resul);


						if($con_meu_time['id_time']==$con_time1['id_time'] || $con_meu_time['id_time']==$con_time2['id_time']){

							?>
							<h1 class="text-center titulo">Proposta de Análise</h1>
							<figure class="mx-auto" style="width:400px;">
								<img style="width:400px;" src="./img/analisador.svg">
							</figure>
							<form class="text-center" name="form-analise" method="POST" action="#">
								<input class="btn btn-danger"  style="background-color:#ff3c00;" type="submit" name="aceitar" value="Aceitar">
							</form>
							<?php

							if(isset($_POST['aceitar'])){
								$sqlalt='update partidas set id_analisador='.$id_analisador.' where id_partida='.$id_partida.';';

								$alterar=mysqli_query($conexao, $sqlalt);

								if($alterar){
									echo('<script> window.location="pagina_partida.php?info=true&id_partida='.$id_partida.'"; </script>');
								}
							}
						}
					}
				}
			?>
		</main>

		<!-- Rodapé -->
		<?php 
			include('footer.php');
		?>
	</body>
</html>
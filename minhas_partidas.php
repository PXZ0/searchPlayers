<?php
	include('conexao.php');
	session_start();
	$pagina=2;
	include('formatar_data.php');
	include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Styles -->
		<link rel="stylesheet" href="./css/style_header.css">
		<link rel="stylesheet" href="./css/style_footer.css">
		<link rel="stylesheet" href="./css/style_home.css">
		<link rel="stylesheet" href="./css/style_partidas.css">
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Partidas da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>

	<body>
		<?php
			include('header.php');
		?>

		<main>
			<?php
				$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

				$resul=mysqli_query($conexao, $sqlbu);

				$con_time=mysqli_fetch_array($resul);


				$sqlbu='select * from partidas where id_time1='.$con_time['id_time'].' or id_time2='.$con_time['id_time'].';';

				$resul=mysqli_query($conexao, $sqlbu);

				$linhas=mysqli_num_rows($resul);

				if($linhas==0){
					?>

						<div class="mx-auto" style="width:300px;">

							<img class="ausencia_img" style="width: 300px;" src="./img/sem_partidas">

						</div>

						<p class="text_mensagem text-center">
							Seu time não tem nenhuma partida. 

							<?php

							if($_SESSION['tipo_usuario']==2){

								$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

								$resul=mysqli_query($conexao, $sqlbu);

								if(mysqli_num_rows($resul)){
											
									?>
										<a href="times.php">
											Clique aqui
										</a>
										para procurar um time e marcar uma partida!
									<?php
								}
							?>
						</p>
						<?php
					}

				}else{

					?>
					<section class="d-flex align-items-center flex-column">
						<p class="titulo">
							Proximas Partidas
						</p>
					</section>
					<?php

					while($con_part=mysqli_fetch_array($resul)){

						$sqlbu='select * from times where id_time='.$con_part['id_time1'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time1=mysqli_fetch_array($resul);

						$sqlbu='select * from times where id_time='.$con_part['id_time2'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time2=mysqli_fetch_array($resul);						

						?>
						<div class="card mb-3 mx-auto" style="max-width: 800px; background-color: #222;">
							<a style="color:#fff;" href="pagina_partida.php?info=true&id_partida=<?php echo($con_part['id_partida'])?>">
			  					<div class="row no-gutters">
			    					<div class="col-md-2">
			     						<?php
				     						$foto=7;
				     						include('foto_time.php');
			     						?>
			    					</div>

			  						<div class="col-md-8">
			     						<div class="card-body">
				      						
			      							<p class="text-center">
			      								Versus
			      							</p>
			      							<p class="text-center">
			      								Data:
			      								<?php
			      									echo formatarData($con_part['data']);
			      								?>
			      							</p>

			      							<p class="text-center">
			      								Hora:
			      								<?php
			      									echo formatarHora($con_part['hora']);
			      								?>
			      							</p>

			      							<?php
			      								if(!empty($con['campeonato'])){
			      									echo($con['<p class="text-center">campeonato'.$con['campeonato'].'</p>']);
			      								}
			      							
			      								if(!empty($con['analisador'])){
			      									
			      									echo('<p class="text-center">Analisador: '.$con['analisador'].'</p>');
			      									
			      								}
			      							?>
					      						
			      						</div>
			    					</div>

			    					<div class="col-md-2">
			     						<?php
				     						$foto=6;
				     						include('foto_time.php');
			     						?>
			    					</div>
			  					</div>
			  				</a>
						</div>
						<?php
					}
				}
			?>
		</main>

		<?php 
			include('footer.php');
		?>
	</body>
</html>
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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Times do Usuario da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main>
			<?php 
				$sqlbu='select id_time from jogadores_time where id_jogador='.$_SESSION['id_usuario'].';';
				
				$resul=mysqli_query($conexao, $sqlbu);

				if(!mysqli_num_rows($resul)){
					?>
					<section class="d-flex align-items-center flex-column">
						<div class="mx-auto" style="width: 400px;">
							<img class="ausencia_img" style="width: 400px;" src="./img/ausencia_dados">
						</div>
						<?php
							$esporte='select * from usuario where id_usuario='.$_SESSION['id_usuario'].';';
							$consulta=mysqli_query($conexao, $esporte);
							$pesquisa=mysqli_fetch_array($consulta);
							if(mysqli_num_rows($consulta)){
								if(!empty($pesquisa['esporte'])){
						?>
							<p class="text-center text_mensagem">
								Ops... Vimos que você não esta em nenhum time.
								<a href="times.php">
									Clique aqui
								</a>
								para ver os times mais pertos de você
							</p>
						<?php
							}else{
						?>
							<p class="text-center text_mensagem">
								Ops... Vimos que você ainda não tem um esporte, escolha um nas 
								 <a href="config_perfil.php">Configurações do Perfil</a>
								!
							</p>
						<?php
							}
						}
						?>
					</section>	

					<?php

				}else{

					while($con_id=mysqli_fetch_array($resul)){

						$sqlbu='select * from times where id_time='.$con_id['id_time'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con=mysqli_fetch_array($resul);

						?>

						<div class="card mx-auto" style="max-width: 540px; background-color: #222222;">
							<a class="link_busca" href="pagina_time.php?info=true&id_time=<?php echo($con['id_time'])?>">
								<div class="row no-gutters">
								    <div class="col-md-4">
								     	<?php
								     		$foto=1;
								     		include('foto_time.php');
								     	?>
								    </div>

								    <div class="col-md-8">
								    	<div class="card-body">
								        	<h3 class="card-title" style="color: #ff3c00;">
								        		<?php echo($con['nome']); ?>
								        	</h3>

								        	<p class="card-text" style="color:#fff;">
								        		Pontuação:
									        	<?php
										        	if($con['pontos']>0){
										        	 	echo(' '.$con['pontos']); 
										        	}else{
										        		echo(' 0');
										        	}
									        	?>
								        	</p>

								        	<p class="card-text" style="color:#fff;">
								        		Esporte:
												<?php
													switch($con['id_esportes']){
														case 1: 
															echo('Futebol');
														break;
														case 2: 
															echo('Basquete');
														break;
														case 3: 
															echo('Vôlei');
														break;
													}
												?>
											</p>

						    				<p class="card-text" style="color:#fff;">
						    					Cidade:
												<?php
													if(!empty($con['cidade_sede'])){
										        	 	echo($con['cidade_sede']); 
										        	}else{
										        		echo('Desconhecida');
										        	}
												?>						    				
						    				</p>
						      			</div>
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
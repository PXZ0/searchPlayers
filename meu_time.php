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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="formulário da Search Players">
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

				if(mysqli_num_rows($resul)){
					$con=mysqli_fetch_array($resul);
					?>
					<section class="d-flex align-items-center flex-column">
						<?php
							$foto=1;
							include('foto_time.php');
						?>
						<h5 class="titulo">
							<?php
								echo($con['nome']);
							?>
							<a class="icon" href="config_time.php">
								<i class="fas fa-pencil-alt"></i>
							</a>
						</h5>
						<div class="card mb-3 mx-auto" style="width:600px; padding:10px; background-color:#222;">
							<p style="text-align:center;" class="text_mensagem text-break">
								Esporte:
								<?php
									switch ($con['id_esportes']){
										case 1:
											echo('Futebol');
										break;

										case 2:
											echo('Basquete');
										break;

										case 3:
											echo('Volei');
										break;

										default:
											echo('Esse esporte não existe');
										break;
									}
								?>
							</p>

							<?php
								if (!empty($con['lema'])) {
									?>

									<p style="font-style:italic; text-align:center;" class="text_mensagem text-break">

									<?php

									echo('"'.$con['lema'].'"');

									?>

									</p>

									<?php
								}
							?>

								
							<p style="text-align:center;" class="text_mensagem text-break">

								<?php

									if(isset($con['cep_sede'])){

										echo($con['cidade_sede'].' - '.$con['uf_sede'].' ');
										echo($con['rua_sede'].' Nº '.$con['numero_sede']);
									}
								?>
							</p> 
						</div>

						<form name="chat_time" method="POST" action="registrochat_time.php">

							<input type="hidden" name="id_time" value=<?php echo($con['id_time']); ?>>

							<button class="btn btn-danger" style="background-color:#ff6535;" type="submit" name="conversar_time">Chat do Time</button>
							<a href="minhas_partidas.php">
								<button class="btn btn-danger" style="background-color:#ff6535;"  type="button">
									Minhas Partidas
								</button>
							</a>
						</form>
					</section>

					<div class="container">
						<?php
							$sqlbu='select * from jogadores_time where id_time='.$con['id_time'].' and tipo_jogador=0;';

							$resul=mysqli_query($conexao, $sqlbu);

							if(mysqli_num_rows($resul)){

								$linhas=mysqli_num_rows($resul);
									
								echo('<h1 style="color:#ff3c00" > Jogadores Fixos ('.$linhas.') </h1>');
			
								while($con_j=mysqli_fetch_array($resul)){

									$sqlbu='select * from usuario where id_usuario='.$con_j['id_jogador'].';';

									$resul_u=mysqli_query($conexao, $sqlbu);

									if(mysqli_num_rows($resul_u)){

										$con_u=mysqli_fetch_array($resul_u);

										$foto=3;

										?>

										<a href="pagina_usuario.php?info=true&id_usuario=<?php echo($con_u['id_usuario']); ?>">
											<p class="text_mensagem">
												<?php
													include('foto_usuario.php');
												?>
											</p>

											<p class="text_mensagem">
												<?php
													echo(ucwords($con_u['nome']));
												?>	
											</p>
										</a>

										<?php
									}
								}
							}
						?>
									
					</div>
					<?php

				}else{

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
								Ops... Vimos que você ainda não tem um time, 
								 <a href="#" data-toggle="modal" data-target="#registrar-time">Clique aqui</a>
								para fazer o cadastro de um!
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
				}
			?>

			<!-- Modal registrar-time -->
			<div class="modal fade" id="registrar-time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    			<div class="modal-dialog">
    				<div class="modal-content">
      					<div class="modal-header">
        					<h5 class="modal-title" id="exampleModalLabel">Registrar Time</h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
     					</div>

	      				<div class="modal-body">	
							<form id="" name="form-time" method="POST" action="registro_time.php">

								<div class="form-group">
									<label for="nome">
										Nome do Time
									</label>
									<input class="form-control" id="nome" name="nome" type="text" placeholder="Nome do time"><br>
								</div>			

								<div class="form-group">
									<label for="lema">Lema do Time</label>
									<textarea id="lema" class="form-control" name="lema" rows="3"></textarea>
								</div>

								<div class="modal-footer">
			        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

			       					<input type="submit" name="registrar" value="Registrar" class="btn btn-primary">
								</div>	
							</form>
	   					</div>
					</div>
				</div>
			</div>
		</main>
		<?php 
			include('footer.php');
		?>
	</body>
</html>
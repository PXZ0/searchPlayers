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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Jogadores da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main>
		<section style="width:300px; margin-bottom:20px;" class="mx-auto">
			<form class="form-inline my-2 my-lg-0" name="search" method="POST" action="#">
     			<input class="form-control mr-sm-2" name="busca_jogadores" type="search" placeholder="Procurar Jogadorxs" aria-label="Search" required value=<?php if(!empty($_POST['busca_jogadores'])){ echo('"'.$_POST['busca_jogadores'].'"'); } ?>>

      			<button class="btn btn-my-2 my-sm-0" style="color:#fff; background-color: #ff3c00" name="filtrar" type="submit"><i class="fas fa-search"></i></button>
      		</form>
      	</section>
			<?php
				$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

				$resul=mysqli_query($conexao, $sqlbu);

				if(mysqli_num_rows($resul)){

					$con_time=mysqli_fetch_array($resul);

					$sqlbu='select * from jogadores_time where id_time='.$con_time['id_time'].';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con_jogadores=mysqli_fetch_array($resul);
				}

				if(isset($_POST['filtrar'])){
					$busca=$_POST['busca_jogadores'];

					$sqlbu='select * from usuario where tipo_usuario=1 and nome like "%'.$busca.'%";';

				}else{

					$sqlbu='select * from usuario where tipo_usuario=1;';
				}

				$resul=mysqli_query($conexao, $sqlbu);

				$linhas=mysqli_num_rows($resul);

				if($linhas==0){

					$pesquisa_filtro=3;
					include('sem_resultados.php');

				}else{

					while($con=mysqli_fetch_array($resul)){

						if($con['id_usuario']!=$_SESSION['id_usuario']){

							?>
							<div class="card mx-auto mt-3" style="max-width: 540px; background-color: #222222;">
								<a style="color:#fff;" class="link_busca" href="pagina_usuario.php?info=true&id_usuario=<?php echo($con['id_usuario'])?>">
									<div class="row no-gutters">
										<div class="col-md-4 ">
										    <figure class="d-flex align-content-center mx-auto" style="width:150px;">
												<?php	 
													$foto=1;						
													include('foto_usuario.php');
												?>
											</figure>
										</div>
									    <div class="col-md-8">
									    	<div class="card-body">
									    		<h5 class="card-title titulo">
													<?php
														echo(ucwords($con['nome']));
													?>
												</h5>
												<p class="text_mensagem  card-text text_mensagem">
													<?php
														switch ($con['sexo']){
															case '1':
																echo('Tipo de Usuário: ');
															break;

															case '2':
																echo('Tipo de Usuária: ');
															break;

															default:
																echo('Tipo de Usuárix: ');
															break;
														}

														switch($con['sexo']){
															case '1':
																switch ($con['tipo_usuario']){
																	case 1:
																		echo('Jogador');
																	break;

																	case 2:
																		echo('Contratante');
																	break;

																	case 3:
																		echo('Analisador');
																	break;

																	default:
																		echo('<p class="text_mensagem">Esse tipo de usuario não existe</p>');
																	break;
																}
															break;

															case '2':
																switch ($con['tipo_usuario']){
																	case 1:
																		echo('Jogadora');
																	break;

																	case 2:
																		echo('Contratante');
																	break;

																	case 3:
																		echo('Analisadora');
																	break;

																	default:
																		echo('<p class="text_mensagem">Esse tipo de usuario não existe</p>');
																	break;
																}
															break;

															default:
																switch ($con['tipo_usuario']){
																	case 1:
																		echo('Jogadorx');
																	break;

																	case 2:
																		echo('Contratante');
																	break;

																	case 3:
																		echo('Analisadorx');
																	break;

																	default:
																		echo('<p class="text_mensagem">Esse tipo de usuario não existe');
																	break;
																}
															break;
														}


														?>
												</p>

												<p class="card-text text_mensagem">
													Localização:
													<?php
														if(isset($con['cidade_usu'])){
															echo ($con['cidade_usu'].' - '.$con['estado_usu']);
														}else{
															echo("Desconhecida");
														}
													?>
												</p>
												<p>
													<?php
													if($con['id_usuario']==$con_jogadores['id_jogador']){		
														echo('Faz parte do seu time');
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
				}					
			?>
		</main>
		<?php 
			include('footer.php');
		?>
	</body>
</html>
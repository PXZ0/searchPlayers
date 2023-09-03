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
		<link rel="stylesheet" href="./css/style_perfil.css">
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Perfil de Usuario da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main>
			<?php
				$sqlbu='select * from usuario where id_usuario='.$_SESSION['id_usuario'].';';

				$resul=mysqli_query($conexao, $sqlbu);

				$con=mysqli_fetch_array($resul);

				if(mysqli_num_rows($resul)){

					?>
					<section class="d-flex align-items-center flex-column">
						<div style="width : 820px" class="container">
							<figure>
								<?php include('banner_usuario.php'); ?>
							</figure>
							<div class="row">
								<div class="col-md-4">
									<figure>							
										<?php
											$foto=2;
											include('foto_usuario.php'); 
										?>
									</figure>
									<h3 class="titulo">
										<?php 
											echo(ucwords($con['nome']));
											if($_SESSION['id_usuario']==$con['id_usuario']){
										?>
											<a class="icon" href="config_perfil.php" >
												<i class="fas fa-pencil-alt"></i>
											</a>
										<?php
											}
										?>
									</h3>
								</div>	
								<p>
									<?php
										switch ($con['tipo_usuario']) {
											case 1:
												switch($_SESSION['sexo']){
													case 1:
														echo('<div class="col-md-4">
																<p class="text_mensagem">Jogador</p>');
													break;
													case 2:
														echo('<div class="col-md-4">
																<p class="text_mensagem">Jogadora</p>');
													break;
													default:
														echo('<div class="col-md-4">
																<p class="text_mensagem">Jogadorx</p>');
													break;
												}
												if(isset($con['cidade_usu'])){
												echo('<p class="text_mensagem">'.$con['cidade_usu'].'-'.$con['estado_usu'].'</p>');
										}
									
												if($con['preco']){
													echo('<p class="text_mensagem">R$'.$con['preco'].'</p>');
												}

												if(!empty($con['esporte'])){
													echo('<p class="text_mensagem">Ranking:');
													if(isset($con['pontos'])){
														echo($con['pontos']);
													}else{
														echo(' 0 ');
													}
													echo(' pts</p>
														</div>
														');
												}else{
													echo('<p class="text_mensagem"></p></div>');
												}
												?>
												<div class="col-md-4">
												<?php
												if(isset($con['esporte'])){
												?>
													<p class="text_mensagem">Esporte:
												<?php
													switch ($con['esporte']) {
														case 1:
															echo('Futebol');
														break;
														
														case 2:
															echo('Basquete');
														break;

														case 3:
															echo('Vôlei');
														break;

														default:
															
														break;
													}
												}else{
													echo('Sem esporte');
												}
											?>
											</p>
											<?php								
											break;
											
											case 2:
											?>
											<div class="col-md-4">
												<?php
													echo('<p class="text-mensagem">Contratante</p>');
													if(isset($con['cidade_usu'])){
														echo('<p class="text_mensagem">'.$con['cidade_usu'].'-'.$con['estado_usu'].'</p>');
													}	
													echo('<p class="text-mensagem">');
													$times='select * from times where id_dono="'.$_SESSION['id_usuario'].'";';
													$consulta_time=mysqli_query($conexao, $times);
													$con_times=mysqli_fetch_array($consulta_time);
													if(mysqli_num_rows($consulta_time)){
														echo('Time: '.$con_times['nome']);
													}else{
														echo('Você ainda não tem um time!');
													}
												?>
												</p>
												<p class="text_mensagem">
													Ranking:
													<?php
														if(isset($con['ranking'])){
															echo($con['ranking']);
														}else{
															echo('0 ');
														}
														echo('pts');
													?>
												</p>
											</div>
											<div class="col-md-4">
											<?php
												if(isset($con['esporte'])){
											?>
												<p class="text_mensagem">Esporte: 
											<?php
													switch ($con['esporte']) {
														case 1:
															echo('Futebol');
														break;
														
														case 2:
															echo('Basquete');
														break;

														case 3:
															echo('Vôlei');
														break;

														default:
															
														break;
													}
												}else{
													echo('Sem esporte');
												}	
											?>
											</p>	
											<?php						
											break;
											//-----------------------------------------------
											case 3:
												echo('<div class="col-md-4">');
												echo('<p class="text_mensagem">Analisadorx</p>');
												if(isset($con['cidade_usu'])){
													echo('<p class="text_mensagem">'.$con['cidade_usu'].'-'.$con['estado_usu'].'</p>');
												}
											break;

											default:
												echo('Esse tipo de usuario não existe');
											break;
										};
									?>
									<p class="text_mensagem">Sexo:
									<?php
										switch ($con['sexo']) {
											case 1:
												echo('Masculino');
											break;

											case 2:
												echo('Feminino');
											break;
											
											default:
												echo('Indefinido');
											break;
										}		
									?>
									</p>
									<p class="text_mensagem">
									<?php
										if(isset($con['data_nascimento'])){
											$data_nascimento=$con['data_nascimento'];
											$date = new DateTime($data_nascimento);
											$interval = $date->diff( new DateTime( date('Y-m-d') ) );
											echo $interval->format( '%Y anos' );
										}							
									?>
									</p>
									<p class="text_mensagem">
										<?php
											if(isset($con['site'])){
										?>
											<a target="_blank" href=<?php echo('"'.$con['site'].'"'); ?>>
												<?php echo($con['site']); ?>
											</a>
										<?php
											}
										?>
									</p>
								</div>
							</div>
						</div>
							<div class="status">
								<?php
									if(!empty($con['sobre'])){														
										echo($con['sobre'].'.');
									}
								?>
							</div>
						</div>
					</section>
					<?php
				}else{
					?>
						<div class="mx-auto" style="width: 400px;">
							<img class="ausencia_img" style="width: 400px;" src="./img/perfil_ausente">
						</div>
						<h5 class="text-center text_mensagem">
							Desculpe... Dados do perfil não encontrados.
						</h5>
					<?php
				}
			?>
		</main>
		<?php 
			include('footer.php');
		?>
	</body>
</html>
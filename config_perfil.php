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
		<link rel="stylesheet" href="./css/style_config.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<meta charset="UTF-8">
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Configurações de Perfil da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main>
			<div class="container">
				<div class="row">
					<?php
						include('nav_config.php');
					?>
				
					<?php
						$sqlbu='select * from usuario where id_usuario='.$_SESSION['id_usuario'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con=mysqli_fetch_array($resul);

						if(mysqli_num_rows($resul)){

					?>
					<section class="col-md-9">
						<h1 class="text-title">Editar Perfil</h1>
						<p class="text">As seguintes informações estaram amostra em seu perfil para outros usuários</p>
						<form name="editar" method="POST" action="#" id="altera_form" enctype="multipart/form-data">

							<div class="form-group">
								<div class="input-group mb-3">
								  	<div class="custom-file">
								    	<input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="inputGroupFileAddon03">
								    	<label class="custom-file-label" for="foto">Adicione uma foto de perfil</label>
								 	 </div>
								</div>

								<figure>
									<?php
										$foto=2;
										include('foto_usuario.php'); 
									?>
								</figure>
								<?php
									if(!empty($_SESSION['foto_usuario'])){
										?>
											<a href="retira_foto.php">
												<button class="btn btn-danger" type="button">
													Retirar Foto
												</button>
											</a>
										<?php
									}
								?>
							</div>

							<div class="form-group">
								<div class="input-group mb-3">
								  	<div class="custom-file">
								    	<input type="file" name="banner" class="custom-file-input" id="banner" name="foto" aria-describedby="inputGroupFileAddon03">
								    	<label class="custom-file-label" for="banner">Adicione um banner</label>
								 	 </div>
								</div>
								<figure>
									<?php include('banner_usuario.php'); ?>
								</figure>
								<?php
									if(!empty($_SESSION['banner_usuario'])){
										?>
											<a href="retira_banner.php">
												<button  class="btn btn-danger" type="button">
													Retirar Banner
												</button>
											</a>
										<?php
									}
								?>
							</div>

							<div class="form-group row">
								<div class="col-md-6">
									<label for="nome">
										Nome
									</label>
									<input class="form-control" type="text" name="nome" value=<?php echo('"'.ucwords($con['nome']).'"'); ?>>
								</div>
							</div>

							<div class="form-group">
								<label for="status">
									Status
								</label>
								<textarea class="form-control" style="resize: none" id="status" name="sobre" row="3"><?php echo($con['sobre']); ?></textarea>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="site">
										Site
									</label>
									<input class="form-control" type="text" name="site" id="site" value=<?php echo($con['site']); ?>>
								</div>
								<div class="col-md-6">
									<label for="esporte">
										Esporte 
									</label>
									<?php
										$times='select * from times where id_dono="'.$_SESSION['id_usuario'].'";';
										$consulta_times=mysqli_query($conexao, $times);
										$jogador='select * from jogadores_time where id_jogador="'.$_SESSION['id_usuario'].'";';
										$consulta_jogador=mysqli_query($conexao, $jogador);
										if(mysqli_num_rows($consulta_times) or mysqli_num_rows($consulta_jogador)){
									?>
									<select class="custom-select" name="esporte" disabled="disabled">
									<?php
										}else{
									?>
									<select class="custom-select" name="esporte">
									<?php
										}
										if(empty($con['esporte'])){
									?>
										<option value=""></option>
									<?php
										}
									?>
										<option value="1" <?php if($con['esporte']==1){ echo('selected'); }?>>Futebol</option>
										<option value="2" <?php if($con['esporte']==2){ echo('selected'); }?>>Basquete</option>
										<option value="3" <?php if($con['esporte']==3){ echo('selected'); }?>>Vôlei</option>
									</select>
								</div>
							</div>

							<button class="btn btn-light" type="button" name="salvar" data-toggle="modal" data-target="#alterar_usuario">
								Salvar Alterações
							</button>
							<a href="perfil.php">
								<button class="btn btn-danger" type="button">Cancelar</button> 
							</a>

					</section>
				</div>	
			</div>

					<!--Modal-Confirmação_de_Senha-->
					<div class="modal fade" id="alterar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel">Confime sua Senha</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        			<span aria-hidden="true">&times;</span>
					        		</button>
					     		</div>
						      	<div class="modal-body">	
									<section class="tudo-box">
										<label for="senha">
											Senha
										</label>
										<input id="senha" type="password" name="senha" placeholder="******"/>
										<span class='erro-validacao template msg-senha'>
									</section>
								</div>
				     			<div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							        <input type="submit" name="alterar" value="Alterar" class="btn btn-primary" data-toggle="modal" data-target="#resposta_alterar">
						</form>
							    </div>
							</div>
						</div>
					</div>

					<!--Modal-Senha-Incorreta -->
					<section>
						<div class="modal fade" id="senha_incorreta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel">Senha Incorreta</h5>
						     		</div>
					     			<div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<!--Modal-Alterações_Completas-->
					<section>
						<div class="modal fade" id="alteracao_completa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel">Alterações Completas</h5>
						     		</div>							     
					     			<div class="modal-footer">
					     				<a href="perfil.php">
								        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
								        </a>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<?php
					if(isset($_POST['alterar'])){
						if(sha1(trim($_POST['senha']))==$con['senha']){
							$nome=$_POST['nome'];
							$sobre=$_POST['sobre'];
							$esporte=$_POST['esporte'];
							$foto=$_FILES['foto'];
							if(!empty($_POST['site'])){
								$dados_site=ltrim($_POST['site'], 'https://');
								$site=('https://'.$dados_site);
							}

							if(!empty($esporte)){
								$sqlalt='update usuario set esporte='.$esporte.' where id_usuario='.$_SESSION['id_usuario'].';';
								
								$alterar=mysqli_query($conexao, $sqlalt);
							}

							if(!empty($site)){
								$sqlalt='update usuario set site="'.$site.'" where id_usuario='.$_SESSION['id_usuario'].';';
								
								$alterar=mysqli_query($conexao, $sqlalt);
							}
							else if(empty($dados_site)){
								$sqlalt='update usuario set site=NULL where id_usuario='.$_SESSION['id_usuario'].';';
								
								$alterar=mysqli_query($conexao, $sqlalt);

							}

							if(!empty($foto['name'])){
								$largura=1500;
								$altura=1500;
								$tamanho=2018000;

								if(!preg_match("/^image\/(jpg|jpeg|gif|bmp|png|webp|svg)$/", $foto['type'])){
									echo('<script>window.alert("Não é uma imagem!"); window.location="config_perfil.php"; </script>');
								}else{

									$dimensoes=getimagesize($foto["tmp_name"]);

									if($dimensoes[0]>$largura){
										echo('<script>window.alert("A largura da imagem não pode ultrapassar '.$largura.' pixels!"); window.location="config_perfil.php"; </script>');
									}else{

										if($dimensoes[1]>$altura){
											echo('<script>window.alert("A altura da imagem não pode ultrapassar '.$altura.' pixels!"); window.location="config_perfil.php"; </script>');
										}else{

											if($foto['size']>$tamanho){
												echo('<script>window.alert("O tamanho da imagem não pode ultrapassar '.$tamanho.' bites!"); window.location="config_perfil.php"; </script>');
											}else{

												preg_match("/\.(jpg|jpeg|gif|bmp|png|webp|svg){1}$/i", $foto['name'], $ext);

												$nome_foto=md5(uniqid(time())).'.'.$ext[1];

												$caminho_imagem='img/foto_perfis/'.$nome_foto;

												move_uploaded_file($foto['tmp_name'], $caminho_imagem);

												$sqlalt='update usuario set foto_usuario="'.$nome_foto.'" where id_usuario='.$_SESSION['id_usuario'].';';

												$alterar_foto=mysqli_query($conexao, $sqlalt);

												if($alterar_foto){
													echo(unlink('img/foto_perfis/'.$_SESSION['foto_usuario']));

													$_SESSION['foto_usuario']=$nome_foto;									
												}
											}
										}
									}
								}
							}

							$banner=$_FILES['banner'];
							if(!empty($banner['name'])){
								$largura=200000;
								$altura=1500;
								$tamanho=2018000;

								if(!preg_match("/^image\/(jpg|jpeg|gif|bmp|png|webp|svg)$/", $banner['type'])){
									echo('<script>window.alert("Não é uma imagem!"); window.location="config_perfil.php"; </script>');
								}else{

									$dimensoes=getimagesize($banner["tmp_name"]);

									if($dimensoes[0]>$largura){
										echo('<script>window.alert("A largura da imagem não pode ultrapassar '.$largura.' pixels!"); window.location="config_perfil.php"; </script>');
									}else{

										if($dimensoes[1]>$altura){
											echo('<script>window.alert("A altura da imagem não pode ultrapassar '.$altura.' pixels!"); window.location="config_perfil.php"; </script>');
										}else{

											if($banner['size']>$tamanho){
												echo('<script>window.alert("O tamanho da imagem não pode ultrapassar '.$tamanho.' bites!"); window.location="config_perfil.php"; </script>');
											}else{

												preg_match("/\.(jpg|jpeg|gif|bmp|png|webp|svg){1}$/", $banner['name'], $ext);

												$nome_banner=md5(uniqid(time())).'.'.$ext[1];

												$caminho_banner='img/banners_perfis/'.$nome_banner;

												move_uploaded_file($banner['tmp_name'], $caminho_banner);

												$sqlalt='update usuario set banner_usuario="'.$nome_banner.'" where id_usuario='.$_SESSION['id_usuario'].';';

												$alterar_banner=mysqli_query($conexao, $sqlalt);

												if($alterar_banner){
													echo(unlink('img/banners_perfis/'.$_SESSION['banner_usuario']));

													$_SESSION['banner_usuario']=$nome_banner;									
												}
											}
										}
									}
								}
							}

							$sqlalt='update usuario set nome="'.$nome.'", sobre="'.$sobre.'" where id_usuario='.$_SESSION['id_usuario'].';';						

							$alterar=mysqli_query($conexao, $sqlalt);

							if($alterar){					
								$_SESSION['nome']=$nome;								

								?>	
								<script type="text/javascript">
									$(document).ready(function(){
										$('#alteracao_completa').modal('show');										
									});
								</script>
								<?php

							}else{
								?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#alteracao_completa').modal('show');	
									});
								</script>
								<?php
							}
						}else{																	
							?>	
							<script type="text/javascript">
								$(document).ready(function(){
									$('#senha_incorreta').modal('show');
								});
							</script>
							<?php
						}
					}										
				}
				include('footer2.php');
			?>
		</main>

		<!--scripts-->
		<script type="text/javascript" src="./js/alterar.js"></script>
	</body>
</html>
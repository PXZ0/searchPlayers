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
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="stylesheet" href="./css/style_chat.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Pagina Principal da Search Players">
		<meta name="keywords" content="Search Players">
		<meta charset="UTF-8">

		<title>Search Players</title>

		<script type="text/javascript">
			function ajax(){
				var req=new XMLHttpRequest();
				req.onreadystatechange=function(){
					if(req.readyState==4 && req.status==200){
						document.getElementById('chat').innerHTML=req.
							responseText;
					}
				}

				req.open('GET', 'dadoschat_time.php', true);
				req.send();
			}	

			setInterval(function(){ajax();}, 1000);
		</script>
	</head>

	<body>
		<?php
			include('header.php');
		?>

		<main class="container">
			<div id="dados">
				 
				<?php

					$sqlbu='select * from times where id_time="'.$_SESSION['id_time'].'";';

					$resul=mysqli_query($conexao, $sqlbu);

					if(mysqli_num_rows($resul)){

						$con_time=mysqli_fetch_array($resul);

						if($_SESSION['tipo_usuario']=='1'){

							?>
								<a class="left_contatos" href="meus_times.php">
							<?php
						}else if($_SESSION['tipo_usuario']=='2'){

							?>
								<a class="left_contatos" href="meu_time.php">
							<?php
						}

						?>

							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  		<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
							</svg>
						</a>

						<section class="chat-container mx-auto">
							<div class="contatos">
								<?php

									$foto=8;
									include('foto_time.php');

									echo('<h4 class="nome_contato">'.($con_time['nome']).' - Chat do Time</h4>');

									echo('<a href="#" data-toggle="modal" data-target="#integrantes"><h4 class="nome_contato"><i class="fas fa-angle-down"></i></h4></a>');
								?>
							</div>

							<div class="chat scrollbar-chat" id="chat"></div>

							<form class="form_chat" method="POST" action="#">

								<input type="hidden" name="nome" placeholder="Seu Nome" value=<?php echo('"'.(ucwords($_SESSION['nome'])).'"');?>>

								<div class="txt_box">
									<textarea class="txt_chat scrollbar-warning" name="mensagem" placeholder="Escreva Aqui..." row="1" required/></textarea>
								</div>

								<button class="chat_btn" type="submit" name="enviar" value="Enviar"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  							<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
									</svg>
								</button>

							</form>
						</section>

						<?php

							if(isset($_POST['enviar'])){
								$nome=$_POST['nome'];
								$mensagem=$_POST['mensagem'];

								$consulta='INSERT INTO chat_time (nome, mensagem, id_time, id_usuario) VALUES ("'.$nome.'", "'.$mensagem.'", "'.$_SESSION['id_time'].'", "'.$_SESSION['id_usuario'].'")';

								$executar=$conexao->query($consulta);

								if($executar){
									echo('<script>window.location="chat_time.php";</script>');
								}

							}

							$sqlbu='select * from jogadores_time where id_time="'.$_SESSION['id_time'].'";';

							$resul=mysqli_query($conexao, $sqlbu);

							$linhas=mysqli_num_rows($resul);
							
							?>
							<section>
								<div class="modal fade" id="integrantes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									 <div class="modal-dialog">
								    	<div class="modal-content">
								      		<div class="modal-header">
								        		<h5 class="modal-title" id="exampleModalLabel">Jogadores do Time (<?php echo($linhas); ?>)</h5>
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        			<span aria-hidden="true">&times;</span>
								        		</button>
								     		</div>

									      	<div class="modal-body">
									      		<div class="container-fluid">	
													<div>
														<?php
															if($linhas==0){
																echo('Esse chat não possui jogadores');
															}else{ 
																while($con_jt=mysqli_fetch_array($resul)){
																	
																	$sqlbu='select * from usuario where id_usuario="'.$con_jt['id_jogador'].'";';

																	$resul_u=mysqli_query($conexao, $sqlbu);

																	$con_u=mysqli_fetch_array($resul_u);
																	
																	if($con_u['id_usuario']==$_SESSION['id_usuario']){
																		$foto=5;
																		include('foto_usuario.php');

																		echo('Você');
																	}else{

																		$foto=4;
																		include('foto_usuario.php');

																		echo(ucwords(' '.$con_u['nome']));
																	}
																}
															}
														?>
													</div>
												</div>
											</div>

								     		<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											</div>		
									    </div>
									</div>
								</div>
							</section>
						<?php
					}
				?>
			</div>
		</main>
		<?php
			include('footer.php');
		?>
	</body>
</html>
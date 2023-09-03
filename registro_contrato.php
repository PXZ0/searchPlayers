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
				if(isset($_POST['contra_pro'])){
					$preco=$_POST['preco'];
					$tipo=$_POST['tipo'];
					$posicao=$_POST['posicao'];	
					$id_contrato=$_POST['id_contrato'];
					$id_para=$_POST['id_para'];
					?>

					<!--Modal-Proposta_Enviada-->
					<section>
						<div class="modal fade" id="pedido_enviado1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel">Sua proposta de contrato foi enviada!</h5>
						     		</div>
						     		<div class="modal-body">
						     			Foi enviada sua proposta de contrato ax administradorx do time, fique atento com suas notificações!
						     		</div>				     
					     			<div class="modal-footer">
					     				<?php echo('<a href="registro_chat.php?info=true&id_destino='.$id_para.'"'); ?>>
								        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
								        </a>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<!--Modal-Proposta_Enviada-->
					<section>
						<div class="modal fade" id="pedido_enviado2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel">Sua proposta de contrato foi enviada!</h5>
						     		</div>
						     		<div class="modal-body">
						     			Foi enviada sua proposta de contrato ao jogador, espere que ele responda.
						     		</div>				     
					     			<div class="modal-footer">
					     				<?php echo('<a href="registro_chat.php?info=true&id_destino='.$id_para.'"'); ?>>
								        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
								        </a>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<?php
					$sqlalt='update contrato set posicao="'.$posicao.'", tipo_contrato='.$tipo.', preco='.$preco.' where id_contrato='.$id_contrato.';';

					$alterar=mysqli_query($conexao, $sqlalt);

					if($alterar){

						if($_SESSION['tipo_usuario']==1){

							$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$id_para.', "'.$_SESSION['nome'].' te enviou uma nova proposta de contrato", 0, "pagina_contrato.php?info=true&id_jogador='.$_SESSION['id_usuario'].'&id_contratante='.$id_para.'");';

						}else if($_SESSION['tipo_usuario']==2){

							$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$id_para.', "'.$_SESSION['nome'].' te enviou uma nova proposta de contrato", 0, "pagina_contrato.php?info=true&id_jogador='.$id_para.'&id_contratante='.$_SESSION['id_usuario'].'");';
						}

						$inserir=mysqli_query($conexao, $sqlin);

						if($inserir){

							if($_SESSION['tipo_usuario']==1){

								?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#pedido_enviado1').modal('show');
									});
								</script>
								<?php

							}else if($_SESSION['tipo_usuario']==2){

								?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#pedido_enviado2').modal('show');
									});
								</script>
								<?php
								
							}
						}
					}
				}

				if(isset($_POST['enviar'])){
					$id_para=$_POST['id_para'];
					$preco=$_POST['preco'];
					$tipo=$_POST['tipo'];
					$posicao=$_POST['posicao'];

					?>

					<!--Modal-Proposta_Enviada-->
					<section>
						<div class="modal fade" id="pedido_enviado1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel">Sua proposta de contrato foi enviada!</h5>
						     		</div>
						     		<div class="modal-body">
						     			Foi enviada sua proposta de contrato ax administradorx do time, fique atento com suas notificações!
						     		</div>				     
					     			<div class="modal-footer">
					     				<?php echo('<a href="registro_chat.php?info=true&id_destino='.$id_para.'"'); ?>>
								        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
								        </a>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<!--Modal-Proposta_Enviada-->
					<section>
						<div class="modal fade" id="pedido_enviado2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel">Sua proposta de contrato foi enviada!</h5>
						     		</div>
						     		<div class="modal-body">
						     			Foi enviada sua proposta de contrato ao jogador, espere que ele responda.
						     		</div>				     
					     			<div class="modal-footer">
					     				<?php echo('<a href="registro_chat.php?info=true&id_destino='.$id_para.'"'); ?>>
								        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
								        </a>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<?php

					if($_SESSION['tipo_usuario']==1){

						$sqlbu='select * from times where id_dono='.$id_para.';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time=mysqli_fetch_array($resul);

						$sqlin='insert into contrato (id_jogador, id_contratante, preco, tipo_contrato, posicao, id_time) values('.$_SESSION['id_usuario'].', '.$id_para.', '.$preco.', '.$tipo.', "'.$posicao.'", '.$con_time['id_time'].');';

					}else if($_SESSION['tipo_usuario']==2){

						$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time=mysqli_fetch_array($resul);

						$sqlin='insert into contrato (id_jogador, id_contratante, preco, tipo_contrato, posicao, id_time) values('.$id_para.', '.$_SESSION['id_usuario'].', '.$preco.', '.$tipo.', "'.$posicao.'", '.$con_time['id_time'].');';

					}

					$inserir=mysqli_query($conexao, $sqlin);

					if($inserir){
						if($_SESSION['tipo_usuario']==1){

							$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$id_para.', "'.$_SESSION['nome'].' deseja entrar no seu time", 0, "registro_chat.php?info=true&id_destino='.$_SESSION['id_usuario'].'");';

						}else if($_SESSION['tipo_usuario']==2){

							$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$id_para.', "'.$_SESSION['nome'].' deseja te contratar para o time dele", 0, "registro_chat.php?info=true&id_destino='.$_SESSION['id_usuario'].'");';
							
						}

						$inserir=mysqli_query($conexao, $sqlin);

						if($inserir){
							
							if($_SESSION['tipo_usuario']==1){

								$sqlin='INSERT INTO chat (mensagem, registro_conversa) VALUES ("Oi, eu sou '.$_SESSION['nome'].' e tenho interresse no de entrar seu time! Pode olhar o meu perfil para saber mais sobre mim", "'.$_SESSION['id_usuario'].'-'.$id_para.'");';

							}else if($_SESSION['tipo_usuario']==2){

								$sqlin='INSERT INTO chat (mensagem, registro_conversa) VALUES ("Oi, eu sou '.$_SESSION['nome'].' administrador do time '.$con_time['nome'].'! Pode olhar o meu perfil para saber mais sobre mim", "'.$_SESSION['id_usuario'].'-'.$id_para.'");';

							}

							$inserir=mysqli_query($conexao, $sqlin);						

							if($inserir){


								if($_SESSION['tipo_usuario']==1){

									$sqlin='INSERT INTO chat (mensagem, registro_conversa, link) VALUES ("Clique aqui para ver a proposta de contrato", "'.$_SESSION['id_usuario'].'-'.$id_para.'", "pagina_contrato.php?info=true&id_jogador='.$_SESSION['id_usuario'].'&id_contratante='.$id_para.'")';

								}else if($_SESSION['tipo_usuario']==2){

									$sqlin='INSERT INTO chat (mensagem, registro_conversa, link) VALUES ("Clique aqui para ver a proposta de contrato", "'.$_SESSION['id_usuario'].'-'.$id_para.'", "pagina_contrato.php?info=true&id_jogador='.$id_para.'&id_contratante='.$_SESSION['id_usuario'].'")';

								}

								$inserir=mysqli_query($conexao, $sqlin);						

								if($inserir){


									if($_SESSION['tipo_usuario']==1){

										?>
										<script type="text/javascript">
											$(document).ready(function(){
												$('#pedido_enviado1').modal('show');
											});
										</script>
										<?php

									}else if($_SESSION['tipo_usuario']==2){

										?>
										<script type="text/javascript">
											$(document).ready(function(){
												$('#pedido_enviado2').modal('show');
											});
										</script>
										<?php
										
									}
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
<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
	$pagina=2;
	include('formatar_data.php');
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
		<link rel="stylesheet" href="./css/style_camp.css">
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
				if(isset($_GET['info'])){
					$id_camp=$_GET['id_camp'];

					$sqlbu='select * from campeonatos where id_campeonato='.$id_camp.';';

					$resul_camp=mysqli_query($conexao, $sqlbu);

					if(mysqli_num_rows($resul_camp)){

						$con_camp=mysqli_fetch_array($resul_camp);
						?>
						<figure class="mx-auto" style="width: 300px;">
						<?php
     						$foto=3;
     						include('foto_camp.php');
     					?>
     					</figure>
     					<section class="mx-auto text_mensagem text-center" style="padding:10px; background:#222; max-width:400px;">
							<h4 class="card-title" style="color:#ff3c00;"><?php echo($con_camp['nome']); ?></h4>
	    					<p class="card-text">
	    						<?php
	    						$sexo='select * from usuario where id_usuario="'.$con_camp['id_org'].'";';
	    						$consulta=mysqli_query($conexao, $sexo);
	    						$pesquisa=mysqli_fetch_array($consulta);
	    						if(mysqli_num_rows($consulta)){
	    							switch($pesquisa['sexo']){
	    								case 1:
	    						?>
	    									Organizador: <?php echo($con_camp['nome_org']); ?>
	    						<?php
	    								break;
	    								case 2:
	    						?>
	    									Organizadora: <?php echo($con_camp['nome_org']); ?>
	    						<?php
	    								break;
	    								default:
	    						?>
	    									Organizadorx: <?php echo($con_camp['nome_org']); ?>
	    						<?php
	    								break;
	    							}
	    						}
	    						?>	
	    					</p>
	    					<p class="card-text">Data de Inicio: <?php echo formatarData($con_camp['d_inicio']); ?></p>
	    					<p class="card-text">Data de Termino: <?php echo formatarData($con_camp['d_termino']); ?></p>
	    					<p class="card-text">Quantidade de Times: <?php echo($con_camp['n_times']); ?></p>
	    					<p class="card-text">Premiação: <?php echo($con_camp['premiacao']); ?></p>

	    					<p class="card-text">

	    						Região: 

	    						<?php echo($con_camp['estado'].'-'.$con_camp['cidade']); ?>	
	    					</p>

	    					<p class="card-text">

	    						Taxa de Inscrição: 

	    						<?php 
	    						if(!empty($con_camp['taxa_inscricao'])){

	    							echo($con_camp['taxa_inscricao']);

	    						}else{

	    							echo('Sem taxa');
	    						} 
	    						?>	
	    					</p>

	    					<p class="card-text">

	    						Esporte do Campeonato:

	    						<?php				        					

	    							switch ($con_camp['esporte']) {
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

	    					<p>
	    						<?php

	    							$sqlbu='select * from times_camp where id_camp='.$id_camp.' and status=1;';

	    							$resul_times=mysqli_query($conexao, $sqlbu);

									if(mysqli_num_rows($resul_times)){

										echo('Times Participantes ');
	    								
	    								echo('('.mysqli_num_rows($resul_times).')');

	    								while($con_times=mysqli_fetch_array($resul_times)){

	    									$sqlbu='select * from times where id_time='.$con_times['id_time'].';';

	    									$resul_time=mysqli_query($conexao, $sqlbu);

	    									$con_time=mysqli_fetch_array($resul_time);

	    									?>
	    								<div>

	    									<a href="pagina_time.php?info=true&id_time=<?php echo($con_time['id_time']); ?>" class="link_busca">
		    									<?php
		    									$foto=8;
		    									include('foto_time.php');

		    									echo($con_time['nome']);
		    									?>
	    									</a>

	    								</div>

	    									<?php
	    								}
	    							}
	    						?>
	    					</p>

    					<?php
    					if($_SESSION['id_usuario']==$con_camp['id_org']){
    						?>
    						<a class="btn btn-danger" style="background:#ff3c00;" href="config_camp.php?info=true&id_camp=<?php echo($id_camp)?>">
	    							Alterar
	    					</a>
    						<?php
    					}else{
    						if($_SESSION['tipo_usuario']==2){

								$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

								$resul_meu_time=mysqli_query($conexao, $sqlbu);

								if(mysqli_num_rows($resul_meu_time)){

									$con_meu_time=mysqli_fetch_array($resul_meu_time);

									$sqlbu='select * from times_camp where id_time='.$con_meu_time['id_time'].';';

									$resul=mysqli_query($conexao, $sqlbu);

									if(!mysqli_num_rows($resul)){

										if($con_camp['n_times']>mysqli_num_rows($resul_times)){

											switch ($con_camp['tipo']) {

												case 1:

													$sqlbu='select * from notifica where notifi="O campeonato '.$con_camp['nome'].' está querendo que você participe dele" and id_usu='.$con_camp['id_org'].' and id_para='.$_SESSION['id_usuario'].' ;';

													$resul=mysqli_query($conexao, $sqlbu);

													if(!mysqli_num_rows($resul)){
														?>
														<p class="text_mensagem text-center">
															Este campeonato é fechado para times exclusivos.
														</p>

														<?php
													}else{
														?>

													<?php
														$esporte_usuario='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
														$consulta_esporte=mysqli_query($conexao, $esporte_usuario);
														$pesquisa_esporte=mysqli_fetch_array($consulta_esporte);
													?>
														<form action="#" method="POST">
														<?php
															if(mysqli_num_rows($consulta_esporte)){
																if(!empty($pesquisa_esporte['esporte']) and $pesquisa_esporte['esporte']==$con_camp['esporte']){
														?>
															<input style="background:#ff6535;" class="btn btn-danger" type="submit" name="entrar" value="Entrar">
														<?php
																}
															}
														?>
														</form>											

														<?php

														if(isset($_POST['entrar'])){

															$sqlin='insert into times_camp (id_time, id_camp, status) values('.$con_meu_time['id_time'].', '.$id_camp.', 1);';

															$inserir=mysqli_query($conexao, $sqlin);

															if($inserir){

																$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con_camp['id_org'].', "O time '.ucwords($con_meu_time['nome']).' entrou no seu campeonato", 0, "pagina_camp.php?info=true&id_camp='.$id_camp.'");';

																$inserir=mysqli_query($conexao, $sqlin);

																if($inserir){
																	echo('<script> window.location="pagina_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
																}
															}
														}
													}
												break;
												
												case 2:
													?>
													<?php
														$esporte_usuario='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
														$consulta_esporte=mysqli_query($conexao, $esporte_usuario);
														$pesquisa_esporte=mysqli_fetch_array($consulta_esporte);
													?>
													<form action="#" method="POST">
													<?php
														if(mysqli_num_rows($consulta_esporte)){
															if(!empty($pesquisa_esporte['esporte']) and $pesquisa_esporte['esporte']==$con_camp['esporte']){
													?>
														<input style="background:#ff6535;" class="btn btn-danger" type="submit" name="p_entrar" value="Pedir para entrar">
													<?php
															}
														}
													?>
													</form>

													<?php
													if(isset($_POST['p_entrar'])){

														$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con_camp['id_org'].', "O time '.ucwords($con_meu_time['nome']).' deseja entrar no seu campeonato", 0, "pagina_time.php?info=true&id_time='.$con_meu_time['id_time'].'&id_camp='.$id_camp.'");';

														$inserir=mysqli_query($conexao, $sqlin);

														if($inserir){

															$sqlin='insert into times_camp (id_time, id_camp, status) values('.$con_meu_time['id_time'].', '.$id_camp.', 0);';

															$inserir=mysqli_query($conexao, $sqlin);

															if($inserir){

																echo('<script> window.location="pagina_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
															}
														}
													}
										
												break;

												case 3:
													
													?>
													<?php
														$esporte_usuario='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
														$consulta_esporte=mysqli_query($conexao, $esporte_usuario);
														$pesquisa_esporte=mysqli_fetch_array($consulta_esporte);
													?>

													<form action="#" method="POST">
													<?php
														if(mysqli_num_rows($consulta_esporte)){
															if(!empty($pesquisa_esporte['esporte']) and $pesquisa_esporte['esporte']==$con_camp['esporte']){
													?>
														<input style="background:#ff6535;" class="btn btn-danger" type="submit" name="entrar" value="Entrar">
													<?php
															}
														}
													?>	
													</form>											

													<?php

													if(isset($_POST['entrar'])){

														$sqlin='insert into times_camp (id_time, id_camp, status) values('.$con_meu_time['id_time'].', '.$id_camp.', 1);';

														$inserir=mysqli_query($conexao, $sqlin);

														if($inserir){

															$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con_camp['id_org'].', "O time '.ucwords($con_meu_time['nome']).' entrou no seu campeonato", 0, "pagina_camp.php?info=true&id_camp='.$id_camp.'");';

															$inserir=mysqli_query($conexao, $sqlin);

															if($inserir){

																echo('<script> window.location="pagina_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
															}
														}
													}

												break;
											}

										}else{

											echo('<p class="text_mensagem text-center">este campeonato alcançou o numero maximo de times</p>');
										}									

									}else{

										?>

										<form action="#" method="POST">
											<input style="background:#ff6535;" class="btn btn-danger" type="submit" name="sair" value="Sair">
										</form>												

										<?php

										if(isset($_POST['sair'])){

											$sqlex='delete from times_camp where id_time='.$con_meu_time['id_time'].' and id_camp='.$id_camp.';';

											$excluir=mysqli_query($conexao, $sqlex);

											if($excluir){

												$sqlbu=' select * from notifica where id_usu='.$_SESSION['id_usuario'].' and id_para='.$con_camp['id_org'].' and notifi="O time '.ucwords($con_meu_time['nome']).' entrou no seu campeonato";';

												$resul=mysqli_query($conexao, $sqlbu);

												if(mysqli_num_rows($resul)){

													$con_noti=mysqli_fetch_array($resul);

													$sqlex='delete from notifica where id_notifica='.$con_noti['id_notifica'].';';

													$excluir=mysqli_query($conexao, $sqlex);

													if($excluir){

														echo('<script> window.location="pagina_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
													}
												}
											}
										}
									}
								}
    						}
    					}
					}
				}
			?>
			</section>
			</div>

		</main>

		<?php 
			include('footer.php');
		?>
	</body>
</html>
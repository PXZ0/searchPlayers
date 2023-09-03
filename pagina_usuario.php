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
		<meta name="description" content="Exclusão de Conta da Search Players">
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
					$id_usuario=$_GET['id_usuario'];

					if($id_usuario==$_SESSION['id_usuario']){
						echo('<script> window.location="perfil.php"; </script>');
						
					}else{

						$sqlbu='select * from usuario where id_usuario='.$id_usuario.';';

						$resul=mysqli_query($conexao, $sqlbu);
						?>

						<div class="card mx-auto mt-3" style="max-width:300px; background-color: #222222;">
							<div class="row no-gutters" style="margin-top:20px;">
								<div style="margin:20px;">
									<div align="center">
										<?php
										if($resul){

											$con=mysqli_fetch_array($resul);
									
											$foto=1;
											include('foto_usuario.php');
													
											?>
							
											<p>
													
												<?php
													switch ($con['tipo_usuario']){
														case 1:
															switch($con['sexo']){
																case 1:
																	echo('<p class="titulo">Jogador: ');
																	echo(ucwords($con['nome']));
																break;
														
																case 2:
																	echo('<p class="titulo">Jogadora: ');
																	echo(ucwords($con['nome']));
																break;
													
																default:
																	echo('<p class="titulo">Jogadorx: ');
																	echo(ucwords($con['nome']));
																break;
															}										
														break;

														case 2:
															echo('Contratante: ');
														break;

														case 3:
															switch($con['sexo']){
																case 1:
																	echo('Analisador');
																break;

																case 2:
																	echo('Analisadora');
																break;

																default:
																	echo('Analisadorx');
																break;
															}
														break;

														default:
															echo('<p class="text_mensagem">Esse tipo de usuarix não existe</p>');
														break;
													}
												?>
					
											</p>

											<p>
									
											<?php

												if(isset($con['cidade_usu'])){
													echo ('<p class="titulo"> Cidade: '.$con['cidade_usu'].'-'.$con['estado_usu'].'</p>');
												}
											?>
											</p>

											<p style="margin-top:40px;">
											<?php

											if($_SESSION['tipo_usuario']==2){

												$sqlbu_time='select * from times where id_dono='.$_SESSION['id_usuario'].';';

												$resul_time=mysqli_query($conexao, $sqlbu_time);

												if(mysqli_num_rows($resul_time)){

													$con_meu_time=mysqli_fetch_array($resul_time);

													$sqlbu='select * from jogadores_time where id_jogador='.$id_usuario.';';

													$resul=mysqli_query($conexao, $sqlbu);

													if(!mysqli_num_rows($resul)){

														?>

														<div style="width:270px;" class="mx-auto row">

															<form method="POST" action="proposta_contrato.php">

																<input  type="hidden" name="id_jogador" value=<?php echo($id_usuario); ?>>
															<?php
															$tipo_esporte='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
															$consulta=mysqli_query($conexao, $tipo_esporte);
															$consulta_esporte=mysqli_fetch_array($consulta);
															if(mysqli_num_rows($consulta)){
																if(!empty($con['esporte']) and $con['esporte']==$consulta_esporte['esporte']){
															?>
																		<button class="btn btn danger" style="margin-bottom:20px; color:#fff; background-color:#ff6535;" type="submit" name="contratar">Contratar</button>
															<?php
																}
															}
															?>
															</form>
														</div>

														<?php
													}else{
														?>

														<div style="width:270px;" class="mx-auto row">

															<form method="POST" action="#">

																<button class="btn btn danger" style="margin-bottom:20px; color:#fff; background-color:#ff6535;" type="submit" name="retirar">Retirar do Time</button>
															</form>
														</div>

														<?php

														if(isset($_POST['retirar'])){
															
															$sqlex='delete from jogadores_time where id_jogador='.$id_usuario.' and id_time='.$con_meu_time['id_time'].';';

															$excluir=mysqli_query($conexao, $sqlex);

															if($excluir){
																echo('<script> window.location="pagina_usuario.php?info=true&id_usuario='.$id_usuario.'"; </script>');
															}
														}

													}

														?>

														<div style="width:270px;" class="mx-auto row">

															<form method="POST" action="registro_chat.php">

																<input type="hidden" name="id_destino" value=<?php echo($id_usuario); ?>>

																<button class="btn btn danger" style="color:#fff; background-color:#ff6535; margin-bottom:20px;" type="submit" name="conversar">Mandar Mensagem</button>
															</form>	
														</div>												

													<?php
												}
											}
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<?php 
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
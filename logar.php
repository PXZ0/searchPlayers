<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Styles -->
		<link rel="stylesheet" href="./css/style_header.css">
		<link rel="stylesheet" href="./css/style_footer.css">
		<link rel="stylesheet" href="./css/style_home.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<script type="text/javascript" src="./js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Login da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<main>
			<!--Modal-Usuario_inexistente-->
			<section>
				<div class="modal fade" id="usuario_inexistente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Este usuárix não existe</h5>
				     		</div>
			     			<div class="modal-footer">
			     				<a href="deslogar.php">
						        	<button type="button" class="btn btn-secondary">OK</button>
						        </a>
						    </div>
						</div>
					</div>
				</div>						
			</section>
			<section>
				<?php
					session_start();
					include('conexao.php');

					$email=strtolower($_POST['email']);
					$senha=sha1(trim($_POST['senha']));


					$sqlbu='select * from usuario where email="'.$email.'";';

					$resul=mysqli_query($conexao, $sqlbu);

					$con=mysqli_fetch_array($resul);
				?>

			<!--Modal-Senha_Incorreta-->
			<section>
				<div class="modal fade" id="senha_incorreta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">
				        			<?php
				        				switch($con['sexo']){
				        					case '1':
				        						echo('A senha do usuário com o e-mail '.$email.' está incorreta!');
											break;
											case '2':
				        						echo('A senha da usuária com o e-mail '.$email.' está incorreta!');
											break;
											default:
				        						echo('A senha dx usuárix com o e-mail '.$email.' está incorreta!');
											break;

				        				}
				        			?>
				        		</h5>
				     		</div>
			     			<div class="modal-footer">
			     				<a href="deslogar.php">
						        	<button type="button" class="btn btn-secondary">OK</button>
						        </a>
						    </div>
						</div>
					</div>
				</div>						
			</section>

				<?php

					if(mysqli_num_rows($resul)){
						if($con['senha']==$senha){
							$_SESSION['nome']=$con['nome'];
							$_SESSION['id_usuario']=$con['id_usuario'];
							$_SESSION['foto_usuario']=$con['foto_usuario'];
							$_SESSION['banner_usuario']=$con['banner_usuario'];
							$_SESSION['tipo_usuario']=$con['tipo_usuario'];
							$_SESSION['sexo']=$con['sexo'];
							$_SESSION['esporte']=$con['esporte'];
							$_SESSION['estado_usu']=$con['estado_usu'];					
							$_SESSION['cidade_usu']=$con['cidade_usu'];	
							$_SESSION['email']=$con['email'];					
						
							header('location:home.php');
						}else{

							unset($_SESSION['id_usuario']);
							?>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#senha_incorreta').modal('show');										
								});
							</script>

						<?php

						}
					}else{
						unset($_SESSION['id_usuario']);
						?>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#usuario_inexistente').modal('show');										
							});
						</script>
						<?php
					}
				?>
			</section>
		</main>
	</body>
</html>
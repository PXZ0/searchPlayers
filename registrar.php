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
		<meta name="description" content="Registro da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<main>
			<!--Modal-Cadastro_Completo-->
			<section>
				<div class="modal fade" id="cadastro_completo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Cadastradx com sucesso!</h5>
				     		</div>							     
			     			<div class="modal-footer">
			     				<a href="home.php">
						        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
						        </a>
						    </div>
						</div>
					</div>
				</div>						
			</section>

			<!--Modal-Email_em_Uso-->
			<section>
				<div class="modal fade" id="email_em_uso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Este email já está em uso</h5>
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

			<!--Modal-Falha_ao_Cadastrar-->
			<section>
				<div class="modal fade" id="falha_ao_cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Houve uma falha ao Cadastrar</h5>
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
		</main>
	</body>
</html>

<?php 
	session_start();
	include('conexao.php');

	if(isset($_POST['registrar'])){
		$nome=$_POST['nome'];
		$sobrenome=$_POST['sobrenome'];
		$email=strtolower($_POST['email']);
		$senha=sha1(trim($_POST['senha']));
		$tipo_usuario=$_POST['tipo'];

		$sqlbu='select * from usuario where email="'.$email.'";';

		$resul=mysqli_query($conexao, $sqlbu);

		if(!mysqli_num_rows($resul)){

			$sqlin='insert into usuario(nome, email, senha, tipo_usuario) values("'.$nome.' '.$sobrenome.'","'.$email.'","'.$senha.'",'.$tipo_usuario.');';

			$inserir=mysqli_query($conexao, $sqlin); 

			if($inserir){
				
				$sqlbu1='select * from usuario where email="'.$email.'" and senha="'.$senha.'";';

				$resul1=mysqli_query($conexao, $sqlbu1);

				$con2=mysqli_fetch_array($resul1);

				if(mysqli_num_rows($resul1)){
					$_SESSION['nome']=$con2['nome'];
					$_SESSION['id_usuario']=$con2['id_usuario'];
					$_SESSION['foto_usuario']=$con2['foto_usuario'];
					$_SESSION['banner_usuario']=$con2['banner_usuario'];
					$_SESSION['tipo_usuario']=$con2['tipo_usuario'];
					$_SESSION['sexo']=$con2['sexo'];
					$_SESSION['email']=$con2['email'];

					?>
					<script type="text/javascript">
						$(document).ready(function(){
							$('#cadastro_completo').modal('show');										
						});
					</script>
					<?php

				}else{
					?>
					<script type="text/javascript">
						$(document).ready(function(){
							$('#falha_ao_cadastrar').modal('show');										
						});
					</script>
					<?php
				}
			}else{
				?>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#falha_ao_cadastrar').modal('show');										
					});
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#email_em_uso').modal('show');										
				});
			</script>
			<?php
		}
	}
?>
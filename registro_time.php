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
		<script type="text/javascript" src="./js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Registro de time da Search Players">
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
				        		<h5 class="modal-title" id="exampleModalLabel">Time cadastrado com sucesso!</h5>
				     		</div>							     
			     			<div class="modal-footer">
			     				<a href="meu_time.php">
						        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
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
				        		<h5 class="modal-title" id="exampleModalLabel">Houve uma falha ao Cadastrar seu time</h5>
				     		</div>
			     			<div class="modal-footer">
			     				<a href="meu_time.php">
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
	if(isset($_POST['registrar'])){
		$esporte_usuario='select * from usuario where id_usuario='.$_SESSION['id_usuario'].';';
		$consulta=mysqli_query($conexao, $esporte_usuario);
		$pesquisa=mysqli_fetch_array($consulta);
		if(mysqli_num_rows($consulta)){
			$tipo_esporte=$pesquisa['esporte'];
		}
		$nome=$_POST['nome'];
		$esporte=$tipo_esporte;
		$id_dono=$_SESSION['id_usuario'];
		$lema=$_POST['lema'];

		$sqlbu='select * from times where nome="'.$nome.'" and id_esportes='.$esporte.';';

		$resul=mysqli_query($conexao, $sqlbu);

		if(!mysqli_num_rows($resul)){

			$sqlin='insert into times(nome, id_dono, id_esportes, lema) values("'.$nome.'",'.$id_dono.', '.$esporte.', "'.$lema.'");';

			$inserir=mysqli_query($conexao, $sqlin);

			if($inserir){
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
					$('#email_em_uso').modal('show');										
				});
			</script>
			<?php
		}
	}
?>
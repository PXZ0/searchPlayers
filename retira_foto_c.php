<?php
	session_start();
	include('verifica_login.php');
	include('conexao.php');
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
		<meta name="description" content="Retirar Foto">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>

	<body>
		<?php
			include('header.php');
		?>
		<main>

			<?php
				if($_GET['id_camp']){

					$id_camp=$_GET['id_camp'];

					$sqlbu='select * from campeonatos where id_campeonato='.$id_camp.';';

					$resul=mysqli_query($conexao, $sqlbu);

					if(mysqli_num_rows($resul)){

						?>

						<!--Modal-Alterações_Completas-->
						<section>
							<div class="modal fade" id="alteracao_completa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<h5 class="modal-title" id="exampleModalLabel">Alterações Completas</h5>
							     		</div>							     
						     			<div class="modal-footer">
						     				<a href="pagina_camp.php?info=true&id_camp=<?php echo($id_camp);?>">
									        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
									        </a>
									    </div>
									</div>
								</div>
							</div>
						</section>
					
						<!--Modal-Falha_ao_Fazer_a_Alteração-->
						<section>
							<div class="modal fade" id="falha_alteracao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<h5 class="modal-title" id="exampleModalLabel">Houve uma falha ao fazer a alteração</h5>
							     		</div>
						     			<div class="modal-footer">
						     				<a href="pagina_camp.php?info=true&id_camp=<?php echo($id_camp);?>">
									        	<button type="button" class="btn btn-secondary">OK</button>
									        </a>
									    </div>
									</div>
								</div>
							</div>				
						</section>

						<?php
					
						$con_camp=mysqli_fetch_array($resul);

						if($_SESSION['id_usuario']==$con_camp['id_org']){ 

							$sqlalt= 'update campeonatos set foto = NULL where id_campeonato = '.$id_camp.';';

							$alterar=mysqli_query($conexao, $sqlalt);

							if($alterar){
								echo(unlink('img/foto_camps/'.$con_camp['foto']));
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
											$('#falha_alteracao').modal('show');										
										});
									</script>
								<?php
							}
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
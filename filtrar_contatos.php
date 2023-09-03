<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="./css/style_header.css">
		<link rel="stylesheet" href="./css/style_footer.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="stylesheet" href="./css/style_chat.css">
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<meta charset="UTF-8">
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Pagina Principal da Search Players">
		<meta name="keywords" content="Search Players">
	</head>

	<body>
		<?php
			include('header.php');
		?>

		<main>
			<?php
				include('pesquisa.php')
			?>
		    <?php
		    	include('filtro.php');
		    ?>
			<?php
				if(isset($_POST['filtrar'])){
						$tipo_usuario=$_POST['tipo_usuario'];
						$esporte_usuario=$_POST['esporte_usuario'];
						$sexo=$_POST['sexo'];
						$pagina=(isset($_POST['pagina']))? $_POST['pagina'] : 1;
						$sql='select * from usuario where tipo_usuario="'.$tipo_usuario.'" and esporte="'.$esporte_usuario.'" and sexo="'.$sexo.'";';
						$resul=mysqli_query($conexao, $sql);

						$busca=mysqli_num_rows($resul);

						if($busca==0){
							$pesquisa_filtro=2;
							include('sem_resultados.php');
						}
								
						while($con=mysqli_fetch_array($resul)){
				?>
				<div class="card mb-3 mx-auto" style="max-width: 540px; background-color: #222;">
  					<div class="row no-gutters">
    					<div class="col-md-4">
     					 	<figure class="d-flex align-content-center mx-auto" style="width: 150px;">
								<?php	 
									$foto=1;						
									include('foto_usuario.php');
								?>
							</figure>
    					</div>
  						<div class="col-md-8">
								<div class="card-body">
								    <h5 class="titulo">
								    	<?php echo(ucwords($con['nome'])); ?>								    		
								    </h5>

									    <?php
									    	if($con['sexo']=='2'){
									    ?>
									    <p class="text_mensagem">Usuária: 
									    	<?php
												switch($con['tipo_usuario']){
					    							case '1': 
					    								echo('Jogadora de Aluguel.');
									    			break;

									    			case '2': 
									    				echo('Administradora de um Time.');
									    			break;

									    			case '3': 
									    				echo('Analisadora de Partidas.');
									    			break;
									    		}
											?>
										</p>
									    <?php
									    	}
									    	else if($con['sexo']=='1'){
									    ?>
									    <p class="text_mensagem">Usuário: 
									    	<?php
												switch($con['tipo_usuario']){
					    							case '1': 
					    								echo('Jogador de Aluguel.');
									    			break;

									    			case '2': 
									    				echo('Administrador de um Time.');
									    			break;

									    			case '3': 
									    				echo('Analisador de Partidas.');
									    			break;
									    		}
											?>
										<?php
											}
									    	else{
									    ?>
									    <p class="text_mensagem">Usuárix: 
									    	<?php
												switch($con['tipo_usuario']){
					    							case '1': 
					    								echo('Jogadorx de Aluguel.');
									    			break;

									    			case '2': 
									    				echo('Administradorx de um Time.');
									    			break;

									    			case '3': 
									    				echo('Analisadorx de Partidas.');
									    			break;
									    		}
									    	
									    	}
											?>
										</p>
										<p class="text_mensagem">Esporte: 
									    	<?php
												switch($con['esporte']){
					    							case '1': 
					    								echo('Futebol.');
									    			break;

									    			case '2': 
									    				echo('Basquete.');
									    			break;

									    			case '3': 
									    				echo('Vôlei.');
									    			break;
									    			default:
									    				echo('Nenhum');
									    			break;
									    		}
											?>
										</p>
									<form method="POST" action="registro_chat.php">
										<input type="hidden" name="id_destino" value=<?php echo($con['id_usuario']); ?>>
										<input type="submit" name="conversar" value="Conversar" style="background-color:#ff3c00;" class="btn btn-danger">
									</form>
								</div>
							</div>
						</div>
    				</div>
					<?php
					}
					?>
		</main>
		<?php
			}else{
				echo('<script>window.location="contatos_chat.php";</script>');
			}
		?>
		<?php
			include('footer.php');
		?>
	</body>
</html>
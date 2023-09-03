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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Times do Usuario da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>

	<body>
		<?php
			include('header.php');
		?>
		<main>
			<section>	

				<form class="form-inline my-2 my-lg-0 mx-auto" style="width:300px;" name="search" method="POST" action="#">
	     			<input class="form-control mr-sm-2" name="busca_times" type="search" placeholder="Procure um time" aria-label="Search" required value=<?php if(!empty($_POST['busca_times'])){ echo('"'.$_POST['busca_times'].'"'); } ?>>

	      			<button class="btn btn-my-2 my-sm-0" style="color: #fff; background-color: #ff3c00" name="filtrar" type="submit"><i class="fas fa-search"></i></button>
	      		</form>

	      	</section>

			<?php 
				if(isset($_POST['filtrar'])){
					$busca=$_POST['busca_times'];

					$sqlbu='select * from times where nome like "%'.$busca.'%";';
				}else{
					if(empty($_SESSION['estado_usu']) && empty($_SESSION['estado_usu'])){
						$sqlbu='select * from times;';
					}else{
						$sqlbu='select * from times where uf_sede="'.$_SESSION['estado_usu'].'" or cidade_sede="'.$_SESSION['cidade_usu'].'";';
					}
				}

				$resul=mysqli_query($conexao, $sqlbu);

				if(mysqli_num_rows($resul)){
											
					while($con=mysqli_fetch_array($resul)){

						if($con['id_dono']!=$_SESSION['id_usuario']){

							?>
							<div class="card mx-auto mt-3" style="max-width: 540px; background-color: #222222;">
								<a class="link_busca" href="pagina_time.php?info=true&id_time=<?php echo($con['id_time'])?>">
									<div class="row no-gutters">
										<div class="col-md-4 ">
										    <figure class="d-flex align-content-center mx-auto" style="width: 150px;">
												<?php	 
													$foto=1;						
													include('foto_time.php');
												?>
											</figure>
										</div>

									    <div class="col-md-8">
									    	<div class="card-body">
									    		<h5 class="card-title titulo">
													<?php
														echo($con['nome']);
													?>
												</h5>

												<p class="card-text text_mensagem">
													Esporte:
													<?php
														switch ($con['id_esportes']){
															case 1:
																echo('Futebol');
															break;

															case 2:
																echo('Basquete');
															break;

															case 3:
																echo('Volei');
															break;

															default:
																echo('Esse esporte não existe');
															break;
														}
													?>
												</p>

												<p class="card-text text_mensagem">
													Localização da Sede:
													<?php
														if(isset($con['cidade_sede'])){
															echo ($con['cidade_sede'].' - '.$con['uf_sede']);
														}else{
															echo("Desconhecida");
														}
													?>
												</p>
											</div>
										</div>
									</div>
								</a>
							</div>
							<?php
						}
					}
				}else{
					?>
						<section class="d-flex align-items-center flex-column" style="margin-top: 25px;">
							<div class="mx-auto" style="width: 400px;">
								<img class="ausencia_img" style="width: 400px;" src="./img/ausencia_dados">
							</div>
							<p class="text-center text_mensagem">
								Ops...Nenhum Time Encontrado
							</p>
						</section>	
					<?php
				}
			?>
		</main>
		<?php 
			include('footer.php');
		?>
	</body>
</html>
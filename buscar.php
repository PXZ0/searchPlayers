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
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Pagina Principal da Search Players">
		<meta name="keywords" content="Search Players">
		<meta charset="UTF-8">

		<title>Search Players</title>
		
	</head>
	
	<body>
		<!-- Cabeçario -->
		<?php 
			include('header.php');
		?>
		<main>
			<?php

				if(isset($_POST['busca'])){
					$busca=$_POST['busca'];
					?>

					<form name="filtro" method="POST" action="#">
						<nav class="text-center">
							<input type="hidden" name="busca" value=<?php  echo('"'.$busca.'"'); ?>>
							<input type="submit" name="usuarios" value="Usuárixs" style="background-color:#ff3c00;" class="btn btn-danger">
							<input type="submit" name="times" value="Times" style="background-color:#ff3c00;" class="btn btn-danger">
						</nav>
					</form>

					<?php	

						$aparecer=0;

						if(isset($_POST['usuarios'])){

							include('busca_usuario.php');

						}else if(isset($_POST['times'])){

							include('busca_time.php');

						}


						if(!isset($_POST['times']) && !isset($_POST['usuarios'])){

							if($_SESSION['tipo_usuario']==2){

								include('busca_usuario.php');

							}else{

								include('busca_time.php');
							}
						}
				}else{
					echo('<script>window.location="home.php";</script>');
				}
			?>	
		</main>
		<?php
			include('footer.php');
		?>
	</body>
</html>
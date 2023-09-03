<?php
	if(!isset($_SESSION['id_usuario'])){
		unset($_SESSION['id_usuario']);
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
					<!--Scripts-->
					<script type="text/javascript" src="./js/jquery-3.5.1.min.js"></script>
					<script type="text/javascript" src="./js/bootstrap.min.js"></script>
					<script src='https://kit.fontawesome.com/a076d05399.js'></script>
					<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
					<meta charset="UTF-8">
					<title>Search Players</title>
					<meta name="author" content="Equipe Search Players">
					<meta name="description" content="Verificação de Login">
					<meta name="keywords" content="Search Players">
				</head>
				<body>
					<main class="bg" style="margin-top: 150px">	
						<h4 class="text-center titulo">
							Você precisa estar logado para acessar essa página.
						</h4>
						<h4 class="text-center titulo">
							Aperte em 'OK' para ir a pagina de login.
						</h4>
						<section class="box-veri rounded mx-auto " style="width:50px; margin-top:15px;">
							<a href="deslogar.php">
								<button class="btn btn-success">
									OK
								</button>
							</a>
						</section>
					</main>	
				</body>
			</html>
			<?php
		exit;
	}
?>
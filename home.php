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
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Pagina Principal da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<!-- Cabeçario -->
		<?php 
			include('header.php');
		?>
		<main class="principal">
			<section id="carouselhome" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselhome" data-slide="0" class="active"></li>
					<li data-target="#carouselhome" data-slide="1"></li>
					<li data-target="#carouselhome" data-slide="2"></li>
				</ol>
			  	<div class="carousel-inner">
			   		<figure class="carousel-item active">
			  			<img src="./img/banner1.png" class="d-block w-100">
			   		</figure>
					<figure class="carousel-item">
				  		<img src="./img/banner2.png" class="d-block w-100">
				  	</figure>
				  	<figure class="carousel-item">
				  		<img src="./img/banner3.gif" class="d-block w-100">
				  	</figure>
				</div>
				<a class="carousel-control-prev" href="#carouselhome" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselhome" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				</a>
			</section>

			<!-- Como search players funciona -->
			<section class="container">
				<div class="row">
					<div class="col-12">
						<h3 class="main-title">
							O que é Search_Players ?
						</h3>
					</div>
					<div class="col-md-6">
						<h3 class="slogan-title">"Entrando em jogo para ganhar."</h3>
						<p>&emsp;É um website para alugar jogadores, que oferece as vantagens:</p>
						<ul class="sobre-list">
							<li>
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  									<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
								</svg>
								Promover ao usuário um site funcional para alugar jogadores ou ser alugado;
							</li>
							<li>
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  									<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
								</svg>
								Proporcionar partidas e campeonatos;
							</li>
							<li>
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  									<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
								</svg>
								Dar total suporte nas partidas, na qual seriam todas avaliadas por um avaliador;
							</li>
							<li>
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  									<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
								</svg>
								E por fim dar uma avaliação para os jogadores pra maior posicionamento dos jogadores no ranking;
							</li>
							<li>
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  									<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
								</svg>
								Cumprir os objetivos de desenvolvimento sustável e promover aos usuários o bem-estar da saúde, inovação e infraestrutura.
							</li>
						<ul>
					</div>
					<figure class="col-md-6">
						<img class="img-fluid" src="./img/figure1.jpg">
					</figure>
				</div>
			</section>
		</main>
		<!-- Rodapé -->
		<?php 
			include('footer.php');
		?>
	</body>
</html>
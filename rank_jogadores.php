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
		<link rel="stylesheet" href="./css/style_rank.css">
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Ranking da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main class="d-flex align-items-center flex-column">			
			<?php
				include('menu_rank.php');
			?>
			<section style="margin-top: 25px;">
				<form method="POST" action="#" class="mx-auto" style="width: 244px;">
					<button type="submit" name="futebol" class="btn btn-secondary">Futebol</button>
					<button type="submit" name="basquete" class="btn btn-secondary">Basquete</button>
					<button type="submit" name="volei" class="btn btn-secondary">Vôlei</button>
				</form>
			<?php
				if(isset($_POST['basquete'])){
			?>
				<script type="text/javascript">
					function ajax(){
						var req=new XMLHttpRequest();
						req.onreadystatechange=function(){
							if(req.readyState==4 && req.status==200){
								document.getElementById('ranking').innerHTML=req.responseText;
							}
						}

						req.open('GET', 'dadosrank_jogadoresbasquete.php', true);
						req.send();
					}	

					setInterval(function(){ajax();}, 1000);
				</script>
			<?php
				}
				else if(isset($_POST['volei'])){
			?>
				<script type="text/javascript">
					function ajax(){
						var req=new XMLHttpRequest();
						req.onreadystatechange=function(){
							if(req.readyState==4 && req.status==200){
								document.getElementById('ranking').innerHTML=req.responseText;
							}
						}

						req.open('GET', 'dadosrank_jogadoresvolei.php', true);
						req.send();
					}	

					setInterval(function(){ajax();}, 1000);
				</script>
			<?php
				}
				else{
			?>
				<script type="text/javascript">
					function ajax(){
						var req=new XMLHttpRequest();
						req.onreadystatechange=function(){
							if(req.readyState==4 && req.status==200){
								document.getElementById('ranking').innerHTML=req.responseText;
							}
						}

						req.open('GET', 'dadosrank_jogadoresfutebol.php', true);
						req.send();
					}	

					setInterval(function(){ajax();}, 1000);
				</script>
			<?php
				}
			?>

		</script>
			<div id="ranking"></div>
			</section>
		</main>
		<footer>
		<?php 
			include('footer.php');
		?>
		</footer>
	</body>
</html>
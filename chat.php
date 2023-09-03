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
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="stylesheet" href="./css/style_chat.css">
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

		<script type="text/javascript">
			function ajax(){
				var req=new XMLHttpRequest();
				req.onreadystatechange=function(){
					if(req.readyState==4 && req.status==200){
						document.getElementById('chat').innerHTML=req.
							responseText;
					}
				}

				req.open('GET', 'dados_chat.php', true);
				req.send();
			}	

			setInterval(function(){ajax();}, 1000);

		</script>

	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main class="container">
			<a class="left_contatos" href="contatos_chat.php">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  		<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
				</svg>
			</a>
			<section class="chat-container mx-auto">
				<div class="contatos">
					<?php
						$dados_usuario='select * from usuario where id_usuario="'.$_SESSION['id_destino'].'";';
						$consulta=mysqli_query($conexao, $dados_usuario);
						$con=mysqli_fetch_array($consulta);
						if(mysqli_num_rows($consulta)){
							$foto=1;
							include('foto_chat.php'); 
					?>
					<h4 class="nome_contato">
						<?php
								echo(ucwords($con['nome']));
							}
						?>
					</h4>
				</div>
				<div class="chat scrollbar-chat" id="chat">
						
				</div>
				<form class="form_chat" method="POST" action="#">
					<input type="hidden" name="nome" placeholder="Seu Nome" value=<?php echo(ucwords($_SESSION['nome'])); ?>>
					<div class="txt_box">
						<textarea class="txt_chat scrollbar-warning" name="mensagem" placeholder="Escreva Aqui..." row="1" required/></textarea>
					</div>
					<button class="chat_btn" type="submit" name="enviar" value="Enviar"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
						</svg>
					</button>
				</form>
			</section>
		</main>
		<?php
			include('footer.php');
		?>

		<?php
		if(isset($_POST['enviar'])){
			$mensagem=trim($_POST['mensagem']);
			$consulta='INSERT INTO chat (mensagem, registro_conversa) VALUES ("'.$mensagem.'", "'.$_SESSION['registro_conversa1'].'")';
			$executar=$conexao->query($consulta);
			if($executar){
				echo('<script>window.location="chat.php";</script>');
			}
		}

		?>
	</body>
</html>
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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Exclusão de Conta da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>

	<body>
		<!-- Cabeçalho -->
		<?php
			include('header.php');
		?>

		<main class="text-center titulo">
			<section class="container">
				<?php
					if(isset($_GET['info'])){
						$id_jogador=$_GET['id_jogador'];

						$id_contratante=$_GET['id_contratante'];

						$sqlbu='select * from contrato where id_jogador='.$id_jogador.' and id_contratante='.$id_contratante.';';

						$resul=mysqli_query($conexao, $sqlbu);

						if(mysqli_num_rows($resul)){

							$con=mysqli_fetch_array($resul);

							$sqlbu='select * from times where id_dono='.$id_contratante.';';

							$resul=mysqli_query($conexao, $sqlbu);

							$con_time=mysqli_fetch_array($resul);

							?>

							<h1>
								<?php
								if($con['status_contrato']==0){
									echo('Proposta de Contrato');
								}else{
									echo('Contrato');
								}
								?>
							</h1>
							<figure class="mx-auto" style="width:400px;">
								<img style="width:400px;" src="./img/contrato.svg">
							</figure>
							<?php
							if($_SESSION['id_usuario']==$id_jogador){
								$sqlbu='select * from usuario where id_usuario='.$id_contratante.';';

								$resul=mysqli_query($conexao, $sqlbu);

								$con_contratante=mysqli_fetch_array($resul);
								?>

								<p class="text_mensagem">
									O administrador
									<?php 
										echo($con_contratante['nome']); 
									?> 
									deseja te contratar para o time 
									<?php 
										echo($con_time['nome']);
									?>
									, para ser um jogador
									<?php 
										if($con['preco']>0){
											echo(' de aluguel pelo preço de R$'.$con['preco']); 
										}  
										if($con['tipo_contrato']==0){ 
											echo(' fixo '); }else{ echo(' Por partida '); }
									?> 
									na posição de 
									<?php 
										echo($con['posicao']); 
									?>
									.
								</p>

								<?php

							}

							if($_SESSION['id_usuario']==$id_contratante){
								$sqlbu='select * from usuario where id_usuario='.$id_jogador.';';

								$resul=mysqli_query($conexao, $sqlbu);

								$con_jogador=mysqli_fetch_array($resul);

								?>

								<p class="text_mensagem">
									O jogador 
									<?php 
										echo($con_jogador['nome']); 
									?> 
										deseja entrar no seu time, para ser um jogador 
									<?php 
										if($con['preco']>0){
											echo('de aluguel pelo preço de R$'.$con['preco']); 
										}  
										if($con['tipo_contrato']==0){
											echo(' fixo '); 
										}else{ 
											echo(' Por partida '); 
										}
									?> 
										na posição de 
									<?php 
										echo($con['posicao']);
									?>
									.
								</p>

								<?php
							}

							?>

							<form name="form_confirmar" method="POST" action="#">
								<input class="btn btn-danger" style="background:#ff3c00" type="submit" name="assinar" value="Assinar Contrato">
							</form>
							<form name="form_confirmar" method="POST" action="proposta_contrato.php">
								<input type="hidden" name="id" value=<?php echo($con['id_contrato']); ?>>
								<input class="btn btn-danger mt-3" style="background:#ff3c00" type="submit" name="contra" value="Enviar Contraproposta">
							</form>

							<?php

							if(isset($_POST['assinar'])){
								$sqlalt='update contrato set status_contrato=1 where id_contrato='.$con['id_contrato'].';';

								$alterar=mysqli_query($conexao, $sqlalt);

								if($alterar){

									$sqlin='insert into jogadores_time (id_jogador, id_contrato, id_time, posicao, esporte, tipo_jogador) values('.$id_jogador.', '.$con['id_contrato'].', '.$con_time['id_time'].', "'.$con['posicao'].'", '.$con_time['id_esportes'].', '.$con['tipo_contrato'].');';

									$inserir=mysqli_query($conexao, $sqlin);

									if($inserir){

										if($_SESSION['id_usuario']==$id_jogador){
											echo('<script> window.location="meus_times.php"; </script>');
										}else{
											echo('<script> window.location="meu_time.php"; </script>');
										}
									}
								}
							}
						}
					}
				?>
			</section>
		</main>

		<!-- Rodapé -->
		<?php 
			include('footer.php');
		?>
	</body>
</html>
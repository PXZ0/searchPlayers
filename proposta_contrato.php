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

		<main>

			<?php
				if(isset($_POST['contra'])){
					$id_contrato=$_POST['id'];

					$sqlbu='select * from contrato where id_contrato='.$id_contrato.';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con=mysqli_fetch_array($resul);

					if($_SESSION['id_usuario']==$con['id_jogador'] || $_SESSION['id_usuario']==$con['id_contratante']){

						if($_SESSION['id_usuario']==$con['id_jogador']){
							$id_para=$con['id_contratante'];
						}else{
							$id_para=$con['id_jogador'];
						}
						?>

						<section class="container">

							<h1 class="titulo">
								Contraproposta de Contrato
							</h1>

							<form name="form_contra" method="POST" action="registro_contrato.php">

								<input type="hidden" name="id_contrato" value=<?php echo($id_contrato);?>>

								<input type="hidden" name="id_para" value=<?php echo($id_para);?>>

								<div class="form-group">
									<label for="posicao">
										Posição
									</label>
									<input class="form-control" type="text" name="posicao" id="posicao" value=<?php echo($con['posicao']); ?>>
								</div>

								<fieldset class="form-group">
									<legend>
										Tipo de Contrato
									</legend>

									<div class="form-check">
										<input class="form-check-input" type="radio" name="tipo" value="0" id="fixo" <?php if($con['tipo_contrato']==0){ echo('checked'); } ?>>
										<label for="fixo">
											Fixo
										</label>
									</div>

									<div class="form-check">
										<input class="form-check-input" type="radio" name="tipo" value="1" id="jogo" <?php if($con['tipo_contrato']==1){ echo('checked'); } ?>>
										<label for="jogo">
											Por jogo
										</label>
									</div>
								</fieldset>

								<div class="form-group">
									<label for="preco">
										Preço de Contrato
									</label>
									<input id="preco" type="number" name="preco" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" value=<?php echo($con['preco']); ?>>
								</div>

								<input class="btn btn-light" type="submit" name="contra_pro" value="Enviar Proposta">

								<a href="times.php">
									<button class="btn btn-danger" type="button">
										Cancelar
									</button>
								</a>
							</form>
						</section>

						<?php
					}

				}else if(isset($_POST['contratar'])){

					if($_SESSION['tipo_usuario']==1){

						$id_para=$_POST['id_contratante'];

						$sqlbu='select * from usuario where id_usuario='.$_SESSION['id_usuario'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con=mysqli_fetch_array($resul);

					}else if($_SESSION['tipo_usuario']==2){

						$id_para=$_POST['id_jogador'];
					}

					?>
						<section class="container">

							<h1 class="titulo">
								Proposta de Contrato
							</h1>

							<form name="form_contrato" method="POST" action="registro_contrato.php">

								<input type="hidden" name="id_para" value=<?php echo($id_para);?>>

								<div class="form-group">
									<label for="posicao">
										Posição
									</label>
									<input class="form-control" type="text" name="posicao" id="posicao">
								</div>

								<fieldset class="form-group">
									<legend>
										Tipo de Contrato
									</legend>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="tipo" value="0" id="fixo">
										<label for="fixo">
											Fixo
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="tipo" value="1" id="jogo">
										<label for="jogo">
											Por jogo
										</label>
									</div>
								</fieldset>

								<div class="form-group">
									<label for="preco">
										Preço de Contrato
									</label>
									<input id="preco" type="number" name="preco" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" value=<?php if(!empty($con['preco'])){echo($con['preco']); }else{
										echo(0); }?>>
								</div>

								<input class="btn btn-light" type="submit" name="enviar" value="Enviar Proposta">
								
								<a href="times.php">
									<button class="btn btn-danger" type="button">
										Cancelar
									</button>
								</a>
							</form>
						</section>
					<?php

				}else{
					echo('comece uma proposta de contrato para estar nessa pagina');
				}
			?>
			
		</main>

		<!-- Rodapé -->
		<?php 
			include('footer.php');
		?>
	</body>
</html>
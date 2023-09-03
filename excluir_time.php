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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Exclusão de Conta da Search Players">
		<meta name="keywords" content="Search Players">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<main style="margin-top:200px;">
			<h5 class="titulo text-center">
				Deseja mesmo fechar seu time? Todos os seus dados dele e de seus jogadores nele seram excluidos.
			</h5>
			<section class="botoes mx-auto" style="width:160px; margin-top:50px;">
				<form name="exclusao" method="POST" action="#">
					<input type="submit" name="excluir" value="Sim" class="btn btn-success">
					<a href="config_time" >
						<button class="btn btn-danger"  type="button">
							Não			
						</button>
					</a>
				</form>
			</section>

			<?php
			if(isset($_POST['excluir'])) {

				$sqlex= 'delete from times where id_dono ='.$_SESSION['id_usuario'].';';

				$excluir=mysqli_query($conexao, $sqlex);

				if($excluir){
					 echo('<script>window.alert("Seu time foi fechado com sucesso!");');
					echo('window.location="meu_time.php"; </script>');

				}else{
					echo('<script>window.alert("Houve um erro ao fechar seu time!"); </script>');
				}
			}
			?>
		</main>
	</body>
</html>
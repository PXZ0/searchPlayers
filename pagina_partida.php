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
		<link rel="stylesheet" href="./css/style_partidas.css">
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Partidas da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>

	<body>
		<?php
			include('header.php');
		?>

		<main>
			<?php
				if(isset($_GET['info'])){

					$id_partida=$_GET['id_partida'];

					$sqlbu='select * from partidas where id_partida='.$id_partida.';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con=mysqli_fetch_array($resul);


					if($resul){

						$sqlbu='select * from times where id_time='.$con['id_time1'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time1=mysqli_fetch_array($resul);


						$sqlbu='select * from times where id_time='.$con['id_time2'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con_time2=mysqli_fetch_array($resul);

						?>

						<div class="card mb-3 mx-auto" style="max-width: 800px; background-color: #222;">
		  					<div class="row no-gutters">
		    					<div class="col-md-4">
		     						<?php
			     						$foto=5;
			     						include('foto_time.php');
		     						?>
		    					</div>

		  						<div class="col-md-4">
		     						<div class="card-body">
			      						<p style="font-size:80px;" class="text-center">
	  										&times;
	  									</p>

	  									<p>
		  									<?php
		  										if(empty($con['id_analisador'])){

								    				if($_SESSION['tipo_usuario']==3){

								    					$sqlbu='select * from notifica where link="proposta_analise.php?id_analista='.$_SESSION['id_usuario'].'&id_partida='.$id_partida.'";';

								    					$resul=mysqli_query($conexao, $sqlbu);

								    					if(!mysqli_num_rows($resul)){
								    						$esportes='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
								    						$consulta=mysqli_query($conexao, $esportes);
								    						$con_esportes=mysqli_fetch_array($consulta);
								    						if(mysqli_num_rows($consulta)){
								    							if($con_esportes['esporte']==$con_time1['id_esportes']){
									    					?>
									    					<form name="form-analisar" method="POST" action="#">

									    						<input type="submit" name="analisar" value="Analisar Partida" class="btn btn-danger" style="background-color:#ff3c00; color:#100b25;">

									    					</form>
									    					<?php
									    						}
									    					}
									    					
								    					}else{

								    						?>
								    						<form class="text-center" name="form-cancelar" method="POST" action="#">

									    						<input class="btn btn-danger" type="submit" name="cancelar" value="Cancelar Análise">
									    						
									    					</form>
									    					<?php
								    					}
								    				}else{
								    					?>
								    						Esta partida não tem um analisador
								    					<?php
								    				}
							    				}else{

							    					$sqlbu='select * from usuario where id_usuario='.$con['id_analisador'].';';

							    					$resul=mysqli_query($conexao, $sqlbu);

							    					$con_ana=mysqli_fetch_array($resul);

							    					if($con_ana['id_usuario']==$_SESSION['id_usuario']){

							    						$sqlbu='select * from notifica where link="proposta_analise.php?id_analista='.$_SESSION['id_usuario'].'&id_partida='.$id_partida.'";';

								    					$resul=mysqli_query($conexao, $sqlbu);

								    					if(mysqli_num_rows($resul)){

								    						?>
								    							<form class="text-center" method="POST" action="#">
								    								<input class="btn btn-danger" type="submit" name="cancelar_ana" value="Cancelar Análise">
								    							</form>
								    						<?php
							    						}
							    					}else{
							    						echo('<p> Analisador: '.ucwords($con_ana['nome']).'</p>');
							    					}
							    				}
							    			?>
						    			</p>
		      						</div>
		    					</div>

		    					<div class="col-md-4">
		     						<?php
			     						$foto=4;
			     						include('foto_time.php');
		     						?>
		    					</div>
		  					</div>
						</div>
						
	    				<?php

	    				if(isset($_POST['cancelar_ana'])){

	    					while ($con_noti=mysqli_fetch_array($resul)) {
	    						$sqlex='delete from notifica where id_notifica='.$con_noti['id_notifica'].';';

	  	    					$excluir=mysqli_query($conexao, $sqlex);
	    					}

	    					if($excluir){
	    						$sqlalt='update partidas set id_analisador=NULL where id_partida='.$id_partida.';';

	    						$alterar=mysqli_query($conexao, $sqlalt);

	    						if($alterar){
	    							echo('<script> window.location="pagina_partida.php?info=true&id_partida='.$id_partida.'"; </script>');
	    						}
	    					}
	    				}

	    				if(isset($_POST['cancelar'])){
	    					
	    					while ($con_noti=mysqli_fetch_array($resul)) {
	    						$sqlex='delete from notifica where id_notifica='.$con_noti['id_notifica'].';';

	  	    					$excluir=mysqli_query($conexao, $sqlex);
	    					}

	    					if($excluir){
	    						echo('<script> window.location="pagina_partida.php?info=true&id_partida='.$id_partida.'"; </script>');
	    					}
	    				}

	    				if(isset($_POST['analisar'])){

	    					$sqlin='insert into notifica(id_usu, id_para, notifi, link) values('.$_SESSION['id_usuario'].', '.$con_time1['id_dono'].', "'.$_SESSION['nome'].' deseja analisar sua partida com o time '.$con_time2['nome'].'", "proposta_analise.php?id_analista='.$_SESSION['id_usuario'].'&id_partida='.$id_partida.'");';

	    					$inserir=mysqli_query($conexao, $sqlin);

	    					if($inserir){

								$sqlin='insert into notifica(id_usu, id_para, notifi, link) values('.$_SESSION['id_usuario'].', '.$con_time2['id_dono'].', "'.$_SESSION['nome'].' deseja analisar sua partida com o time '.$con_time1['nome'].'", "proposta_analise.php?id_analista='.$_SESSION['id_usuario'].'&id_partida='.$id_partida.'");';

								$inserir=mysqli_query($conexao, $sqlin);

								if($inserir){
									echo('<script> window.location="pagina_partida.php?info=true&id_partida='.$id_partida.'"; </script>');
								}	    						    						
	    					}
	    				}
					}
				}
			?>
		</main>

		<?php 
			include('footer.php');
		?>
	</body>
</html>
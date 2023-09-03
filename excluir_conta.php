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
				Deseja mesmo excluir sua conta? Todos os seus dados seram excluidos junto a ela.
			</h5>
				<section class="botoes mx-auto"  style="width:160px; margin-top:50px;">
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#formulario">Sim</a>
					<a href="config_conta">
						<button class="btn btn-danger" type="button">
							Não			
						</button>
					</a>
				</section>

		<!--Modal-FormularioOpiniao-->
				<section>
					<div class="modal fade" id="formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						 <div class="modal-dialog">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel">Por que está deixando nossa plataforma ?</h5>
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        			<span aria-hidden="true">&times;</span>
					        		</button>
					     		</div>
						      	<div class="modal-body">
						      		<div class="container-fluid">	
										<form id="cadastre-form" name="form" method="POST" action="#">
											<div>
												<section>
													<input id="problema1" type="radio" name="problema" value="Problemas_Técnicos_na_Plataforma">
													<label for="problema1">	
														Problemas Técnicos na Plataforma;
													</label>
												</section>

												<section>
													<input id="problema2" type="radio" name="problema" value="Visual_Não_Muito_Atraente"/>
													<label for="problema2">
														Visual Não Muito Atraente;
													</label>
												</section>

												<section>
													<input id="problema3" type="radio" name="problema" value=
													<?php
													switch($_SESSION['sexo']){
														case '1': 
															echo('Não_Fiquei_Satisfeito_Com_o_Serviço');
														break;
														case '2': 
															echo('Não_Fiquei_Satisfeita_Com_o_Serviço');
														break;
														default: 
															echo('Não_Fiquei_Satisfeitx_Com_o_Serviço');
														break;
													}

													?>>
													<label for="problema3">
														<?php
															switch($_SESSION['sexo']){
																case '1': echo('Não Fiquei Satisfeito Com o Serviço;');
																break;
																case '2': echo('Não Fiquei Satisfeita Com o Serviço;');
																break;
																default: echo('Não Fiquei Satisfeitx Com o Serviço;');
																break;
															}
														?>
													</label>
												</section>

												<section>
													<input id="problema4" type="radio" name="problema" value="Incoveniente_Com_Algumx_Usuárix">
													<label for="problema4">
														Incoveniente Com Algumx Usuárix;
													</label>
												</section>

												<section>
													<input id="problema5" type="radio" name="problema" value="Prefiro_Não_Comentar">
													<label for="problema5">
														Prefiro Não Comentar.
													</label>
												</section>

					     		<div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									        <input type="submit" name="excluir" value="Excluir a Conta" class="btn btn-primary">
								   		</form>
								</div>		
						    </div>
						</div>
					</div>
				</section>

		<!---->
			<?php
			if(isset($_POST['excluir'])) {
				$problema=$_POST['problema'];

				$sqlex= 'delete from usuario where id_usuario ='.$_SESSION['id_usuario'].';';

				$excluir=mysqli_query($conexao, $sqlex);

				$form='insert into feedback_saida(nome, email, id_usuario, opiniao) values("'.$_SESSION['nome'].'", "'.$_SESSION['email'].'", "'.$_SESSION['id_usuario'].'", "'.$problema.'")';

				$enviar_opiniao=mysqli_query($conexao, $form);

				if($excluir){
					switch($_SESSION['sexo']){
						case '1': echo('<script>window.alert("Sua conta foi excluida com sucesso, muito obrigado pelo feedback e pelo tempo que esteve conosco!"); window.location="deslogar.php"; </script>');
						break;
						case '2': echo('<script>window.alert("Sua conta foi excluida com sucesso, muito obrigada pelo feedback e pelo tempo que esteve conosco!"); window.location="deslogar.php"; </script>');
						break;
						default: echo('<script>window.alert("Sua conta foi excluida com sucesso, muito obrigadx pelo feedback e pelo tempo que esteve conosco!"); window.location="deslogar.php"; </script>');
						break;
					}

				}else{
					echo('<script>window.alert("Houve um erro ao excluir sua conta!"); </script>');
				}
			}
			?>
		</main>
	</body>
</html>
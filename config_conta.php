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
		<link rel="stylesheet" href="./css/style_config.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon"/>

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Configurações de Conta da Search Players">
		<meta name="keywords" content="Search Players">

		<title>Search Players</title>
	</head>
	<body> 
		<?php
			include('header.php');
		?>
		<main>
			<div class="container">
				<div class="row">
					<?php
						include('nav_config.php');
					?>
					<?php
						$sqlbu='select * from usuario where id_usuario='.$_SESSION['id_usuario'].';';

							$resul=mysqli_query($conexao, $sqlbu);

							$con=mysqli_fetch_array($resul);

							if(mysqli_num_rows($resul)){
								?>
								<section class="col-md-9">
									<h1 class="text-title">Configuração de Conta</h1>
									<p class="text">Essas informações facilitarão as buscas dos times da sua regiões.</p>
									<form name="config_conta" method="POST" action="#" id="altera_form">
										<div form="form-group">	
											<label for="email">
												Endereço de e-mail
											</label>
											<input class="form-control" type="email" name="email" value=<?php echo($con['email']); ?>>
										</div>

										<fieldset class="form-group">
										    <div class="row">
											    <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
											    <div class="col-sm-10">
											    	<div class="form-check">
											        	<input class="form-check-input" type="radio" name="sexo" id="masculino" value="1" <?php if($con['sexo']==1){echo('checked');}?>>
														<label for='masculino'>
															Masculino
											          	</label>
											        </div>
											        <div class="form-check">
											          	<input class="form-check-input" type="radio" name="sexo" id="feminino" value="2" <?php if($con['sexo']==2){echo('checked');}?>>
														<label for="feminino">
															Feminino
											          	</label>
											        </div>
											        <div class="form-check">
											          	<input class="form-check-input" type="radio" name="sexo" id="indefinido" value="NULL" <?php if($con['sexo']==NULL){echo('checked');}?>>
														<label for="indefinido">
															Indefinido
											          	</label>
											        </div>
											    </div>
											</div>
									    </fieldset>

									    <div class="form-group">
										<label for="data_n">
											Data de Nascimento
										</label>
										<input class="form-control" type="date" name="data_n" id="data_n" value=<?php echo($con['data_nascimento'])?> />
										</div>

										<?php
											if($_SESSION['tipo_usuario']==1){
												?>
												<label for="preco">
													Preço de Contrato
												</label>

												<input id="preco" type="number" name="preco" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" value=<?php echo($con['preco'])?>>

												<?php
											}
										?>

										<?php
											$times='select * from times where id_dono="'.$_SESSION['id_usuario'].'";';
											$consulta_times=mysqli_query($conexao, $times);
											$jogador='select * from jogadores_time where id_jogador="'.$_SESSION['id_usuario'].'";';
											$consulta_jogador=mysqli_query($conexao, $jogador);
											if(mysqli_num_rows($consulta_times) or mysqli_num_rows($consulta_jogador)){
										?>
										<fieldset class="form-group" disabled="disabled">
										<?php
											}else{
										?>
										<fieldset class="form-group">
										<?php
											}
										?>
										    <div class="row">
											    <legend class="col-form-label col-sm-2 pt-0">
											    	<?php 
											    		switch($con['sexo']){
											    			case '1': echo('Tipo de Usuário');
											    				break;
											    			case '2': echo('Tipo de Usuária');
											    				break;
											    			default: echo('Tipo de Usuárix');
											    				break;

											    		}
											    	?>
											    </legend>
											    <div class="col-sm-10">
											    	<div class="form-check">
											        	<input class="form-check-input" type="radio" name="tipo" id="jogador" value="1" <?php if($con['tipo_usuario']==1){echo('checked');}?>>
														<label for='jogador'>
															<?php
																switch($con['sexo']){
																	case '1': echo('Jogador');
																		break;
																	case '2': echo('Jogadora');
																		break;
																	default: echo('Jogadorx');
																		break;
																}
															?>
											          	</label>
											        </div>
											        <div class="form-check">
											          	<input class="form-check-input" type="radio" name="tipo" id="adm" value="2" <?php if($con['tipo_usuario']==2){echo('checked');}?>>
														<label for="adm">
															<?php
																switch($con['sexo']){
																	case '1': echo('Administrador de um time');
																	break;

																	case '2': echo('Administradora de um time');
																	break;

																	default: echo('Administradorx de um time');
																	break;
																}
															?>
											          	</label>
											        </div>
											        <div class="form-check">
											          	<input class="form-check-input" type="radio" name="tipo" id="analista" value="3" <?php if($con['tipo_usuario']==3){echo('checked');}?>>
														<label for="analista">
															Analista
											          	</label>
											        </div>
											    </div>
											</div>
									    </fieldset>

										<button class="btn btn-light" type="button" data-toggle="modal" data-target="	#alterar_senha">
											Alterar Senha
										</button>

										<button class="btn btn-light" type="button" name="salvar" data-toggle="modal" data-target="#alterar_usuario">
											Salvar Alterações
										</button>
										
										<a href="perfil.php">
											<button class="btn btn-danger" type="button">Cancelar</button>
										</a>

										<?php
											$times='select * from times where id_dono="'.$_SESSION['id_usuario'].'";';
											$consulta_times=mysqli_query($conexao, $times);
											$jogador='select * from jogadores_time where id_jogador="'.$_SESSION['id_usuario'].'";';
											$consulta_jogador=mysqli_query($conexao, $jogador);
											if(mysqli_num_rows($consulta_times) or mysqli_num_rows($consulta_jogador)){
										?>
										<a href="#">
										 <button class="btn btn-danger" data-toggle="modal" data-target="#excluir_time">Excluir Conta</button>
										</a>
										<?php
											}else{
										?>

										<a href="excluir_conta">
											<button class="btn btn-danger" type="button">Excluir Conta</button>
										</a>
										<?php
											}
										?>	
								</section>
							<?php
							}
						?>	
					</div>
				</div>

				<!--Modal-Confirmação_de_Senha-->
				<div class="modal fade" id="alterar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Confime sua Senha</h5>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        			<span aria-hidden="true">&times;</span>
				        		</button>
				     		</div>
					      	<div class="modal-body">	
								<section class="tudo-box">										
									<label for="senha">
										Senha
									</label>
									<input id="senha" type="password" name="senha" placeholder="******"/>
									<span class='erro-validacao template msg-senha'>
								</section>
							</div>
			     			<div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						        <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
						        </form>	
						    </div>
						</div>
					</div>
				</div>
			
			<!--Modal-Alteração_Senha-->
			<div class="modal fade" id="alterar_senha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="exampleModalLabel">Altere sua Senha</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        			<span aria-hidden="true">&times;</span>
			        		</button>
			     		</div> 
			     		<form name="altera_senha" method="POST" action="#" id="altera_senha">
					      	<div class="modal-body">	
								<section class="tudo-box">								
									<label for="senha_a">
										Senha antiga
									</label>
									<input id="senha_a" type="password" name="senha_a" placeholder="******">
									<span class='erro-validacao template msg-senha_a'></span>
								</section>

								<section class="tudo-box">
									<label for="senha_n">
										Senha Nova
									</label>
									<input id="senha_n" type="password" name="senha_n" placeholder="******"/>
									<span class='erro-validacao template msg-senha_n'></span>
								</section>
							</div>
			     			<div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						        <input type="submit" name="alterar_senha" value="Alterar" class="btn btn-primary">
						    </div>
					    </form>
					</div>
				</div>
			</div>

			<!--Modal-Senha-Incorreta -->
			<section>
				<div class="modal fade" id="senha_incorreta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Senha Incorreta</h5>
				     		</div>
			     			<div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
						    </div>
						</div>
					</div>
				</div>						
			</section>

			<!--Modal-Alterações_Completas-->
			<section>
				<div class="modal fade" id="alteracao_completa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Alterações Completas</h5>
				     		</div>							     
			     			<div class="modal-footer">
			     				<a href="perfil.php">
						        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
						        </a>
						    </div>
						</div>
					</div>
				</div>						
			</section>

			<!--Modal-Exclusão_de_time-->
			<div class="modal fade" id="excluir_time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="exampleModalLabel">AVISO</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        			<span aria-hidden="true">&times;</span>
			        		</button>
			     		</div> 
				      	<div class="modal-body">
				      		<?php
				      		switch($_SESSION['tipo_usuario']){
				      			case 1:	
				      				echo('Vimos que você ainda está em um ou vários times, para trocar excluir a sua conta é necessário sair dos times em que você está! ');
				      			break;
				      			case 2:
									echo('Vimos que você tem um time aberto, para excluir a sua conta é necessário fecha-lo!');
								break;
							}
							?>
						</div>
						<form name="excluir" method="POST" action="#">
			     			<div class="modal-footer">
						        <button type="button" name="ok" class="btn btn-primary" data-dismiss="modal">OK</button>
						    </div>
					    </form>
					</div>
				</div>
			</div>

			<?php
				if(isset($_POST['alterar'])){
					if(sha1(trim($_POST['senha']))==$con['senha']){
						$email=$_POST['email'];						
						$data=$_POST['data_n'];
						$tipo=$_POST['tipo'];

						if(!empty($_POST['preco'])){
							$preco=$_POST['preco'];						

							$sqlalt='update usuario set preco='.$preco.' where id_usuario='.$_SESSION['id_usuario'].';';

							$alterar=mysqli_query($conexao, $sqlalt);
						}

						if(!empty($_POST['sexo'])){
							$sexo=$_POST['sexo'];
							
							$sqlalt='update usuario set sexo='.$sexo.' where id_usuario='.$_SESSION['id_usuario'].';';

							$alterar=mysqli_query($conexao, $sqlalt);

							if($alterar){
								$_SESSION['sexo']=$sexo;
							}
						}

						if(!empty($data)){
							$sqlalt='update usuario set data_nascimento="'.$data.'" where id_usuario='.$_SESSION['id_usuario'].';';
							
							$alterar=mysqli_query($conexao, $sqlalt);
						}

						$sqlalt='update usuario set tipo_usuario='.$tipo.', email="'.$email.'" where id_usuario='.$_SESSION['id_usuario'].';';

						if($con['tipo_usuario']==2){
							if($_SESSION['tipo_usuario']==$tipo){
								$alterar=mysqli_query($conexao, $sqlalt);
							}else{

								$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

								$resul=mysqli_query($conexao, $sqlbu);

								$alterar=mysqli_query($conexao, $sqlalt);
							}
						}else{
							$alterar=mysqli_query($conexao, $sqlalt);
						}

						if($alterar){
							$_SESSION['tipo_usuario']=$tipo;
							?>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#alteracao_completa').modal('show');	
								});
							</script>
							<?php							
						}
					}else{
						?>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#senha_incorreta').modal('show');	
							});
						</script>
						<?php
					}
				}

				if(isset($_POST['alterar_senha'])){
					if(sha1(trim($_POST['senha_a']))==$con['senha']){
						$senha_n=sha1(trim($_POST['senha_n']));

						$sqlalt='update usuario set senha="'.$senha_n.'" where id_usuario='.$_SESSION['id_usuario'].';';

						$alterar=mysqli_query($conexao, $sqlalt);

						if($alterar){
							?>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#alteracao_completa').modal('show');	
								});
							</script>
							<?php
						}

					}else{
						?>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#senha_incorreta').modal('show');	
							});
						</script>
						<?php
					}
				}
				include('footer2.php');
			?>
		</main>

		<!--scripts-->
		<script type="text/javascript" src="./js/alterar.js"></script>
		<script type="text/javascript" src="./js/alterar_senha.js"></script>
	</body>
</html>
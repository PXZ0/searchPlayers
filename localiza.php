<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
?>

<script type="text/javascript">
	function limpa_cep(){
		document.getElementById('bairro').value=("");
		document.getElementById('cidade').value=("");
		document.getElementById('uf').value=("");
	}

	function meucallback(conteudo){
		if (!("erro" in conteudo)){
			document.getElementById('bairro').value=(conteudo.bairro);
			document.getElementById('cidade').value=(conteudo.localidade);
			document.getElementById('uf').value=(conteudo.uf);
		}else{
			limpa_cep();
			alert("CEP não encontrado.");
		}
	}

	function pesquisacep(valor) {
		var cep=valor.replace(/\D/g,'');

		if(cep!=""){
			var valicep=(/^[0-9]{8}$/);

			if(valicep.test(cep)) {
				document.getElementById('bairro').value="Procurando...";
				document.getElementById('cidade').value="Procurando...";
				document.getElementById('uf').value="Procurando...";

	            var script=document.createElement('script');

	            script.src='https://viacep.com.br/ws/'+ cep +'/json/?callback=meucallback';

	            document.body.appendChild(script);
			}else {
				limpa_cep();
				alert("Formato de CEP inválido.");
	        }
		}else {
			limpa_cep();
	    }
	}
</script>

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
		<meta charset="UTF-8">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Configurações de Perfil da Search Players">
		<meta name="keywords" content="Search Players">
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
						<h1 class="text-title">Localizacão</h1>
						<p class="text">Aqui você pode configurar sua localização de atuação, melhorando a forma de encontrar jogos, times e jogadores perto de sua casa.</p>
						<form method="POST" action="#" id="altera_form" name="confima_senha">
							<div class="form-group row">
								<div class="col-sm-6">
									<label for="cep">
										CEP
									</label>
									<input class="form-control" name="cep" type="text" id="cep" size=10 placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" value=<?php if(isset($con['cep_usu'])){ echo($con['cep_usu']); } ?>>
								</div>
								<div  class="col-sm-6">
									<label for="uf">
										Estado
									</label>
									<select class="form-control" id="uf" name="uf">
										<option value="AC" <?php if($con['estado_usu']=="AC"){ echo('selected'); }?>>Acre</option>
										<option value="AL"<?php if($con['estado_usu']=="AL"){ echo('selected'); }?>>Alagoas</option>
										<option value="AP"<?php if($con['estado_usu']=="AP"){ echo('selected'); }?>>Amapá</option>
										<option value="AM"<?php if($con['estado_usu']=="AM"){ echo('selected'); }?>>Amazonas</option>
										<option value="BA"<?php if($con['estado_usu']=="BA"){ echo('selected'); }?>>Bahia</option>
										<option value="CE"<?php if($con['estado_usu']=="CE"){ echo('selected'); }?>>Ceará</option>
										<option value="DF"<?php if($con['estado_usu']=="DF"){ echo('selected'); }?>>Distrito Federal</option>
										<option value="ES"<?php if($con['estado_usu']=="ES"){ echo('selected'); }?>>Espírito Santo</option>
										<option value="GO"<?php if($con['estado_usu']=="GO"){ echo('selected'); }?>>Goiás</option>
										<option value="MA"<?php if($con['estado_usu']=="MA"){ echo('selected'); }?>>Maranhão</option>
										<option value="MT"<?php if($con['estado_usu']=="MT"){ echo('selected'); }?>>Mato Grosso</option>
										<option value="MS"<?php if($con['estado_usu']=="MS"){ echo('selected'); }?>>Mato Grosso do Sul</option>
										<option value="MG"<?php if($con['estado_usu']=="MG"){ echo('selected'); }?>>Minas Gerais</option>
										<option value="PA"<?php if($con['estado_usu']=="PA"){ echo('selected'); }?>>Pará</option>
										<option value="PB"<?php if($con['estado_usu']=="PB"){ echo('selected'); }?>>Paraíba</option>
										<option value="PR"<?php if($con['estado_usu']=="PR"){ echo('selected'); }?>>Paraná</option>
										<option value="PE"<?php if($con['estado_usu']=="PE"){ echo('selected'); }?>>Pernambuco</option>
										<option value="PI"<?php if($con['estado_usu']=="PI"){ echo('selected'); }?>>Piauí</option>
										<option value="RJ"<?php if($con['estado_usu']=="RJ"){ echo('selected'); }?>>Rio de Janeiro</option>
										<option value="RN"<?php if($con['estado_usu']=="RN"){ echo('selected'); }?>>Rio Grande do Norte</option>
										<option value="RS"<?php if($con['estado_usu']=="RS"){ echo('selected'); }?>>Rio Grande do Sul</option>
										<option value="RO"<?php if($con['estado_usu']=="RO"){ echo('selected'); }?>>Rondônia</option>
										<option value="RR"<?php if($con['estado_usu']=="RR"){ echo('selected'); }?>>Roraima</option>
										<option value="SC"<?php if($con['estado_usu']=="SC"){ echo('selected'); }?>>Santa Catarina</option>
										<option value="SP"<?php if($con['estado_usu']=="SP"){ echo('selected'); }?>>São Paulo</option>
										<option value="SE"<?php if($con['estado_usu']=="SE"){ echo('selected'); }?>>Sergipe</option>
										<option value="TO"<?php if($con['estado_usu']=="TO"){ echo('selected'); }?>>Tocantins</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label for="cidade">
							        	Cidade
									</label>
									<input class="form-control" name="cidade" type="text" id="cidade" placeholder="Cidade" size="40" value=<?php if(isset($con['cidade_usu'])){ echo($con['cidade_usu']); } ?>>
								</div>
								<div class="col-sm-6">
							        <label for="bairro">
							        	Bairro
							        </label>
									<input class="form-control" name="bairro" type="text" id="bairro" placeholder="Bairro" size="40" value=<?php if(isset($con['bairro_usu'])){ echo($con['bairro_usu']); } ?>>
								</div>
							</div>
							<button class="btn btn-light" type="button" name="salvar" data-toggle="modal" data-target="#alterar_usuario">
								Salvar Alterações
							</button>

							<a href="perfil.php">
								<button class="btn btn-danger" type="button">Cancelar</button> 
							</a>
						

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
												</form>
											</section>
										</div>
						     			<div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									        <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
									    </div>
									</div>
								</div>
							</div>
						</form>
					</section>

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
					<?php					
					if(isset($_POST['alterar'])){
						if(sha1(trim($_POST['senha']))==$con['senha']){
							$cep=$_POST['cep'];
							$uf=$_POST['uf'];
							$cidade=$_POST['cidade'];
							$bairro=$_POST['bairro'];

							$sqlalt='update usuario set cep_usu="'.$cep.'", estado_usu="'.$uf.'", cidade_usu="'.$cidade.'", bairro_usu="'.$bairro.'" where id_usuario='.$_SESSION['id_usuario'].';';

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
						}

					?>
					</section>				
				</div>
			</div>
			<?php
				include('footer2.php');
			?>
		</main>
	</body>
	<script type="text/javascript" src="./js/alterar.js"></script>
</html>
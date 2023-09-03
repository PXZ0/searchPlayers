<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
?>

<script type="text/javascript">
	function limpa_cep(){
		document.getElementById('rua').value=("");
		document.getElementById('bairro').value=("");
		document.getElementById('cidade').value=("");
		document.getElementById('uf').value=("");
	}

	function meucallback(conteudo){
		if (!("erro" in conteudo)){
			 document.getElementById('rua').value=(conteudo.logradouro);
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
				document.getElementById('rua').value="Procurando...";
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
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />
		<meta charset="UTF-8">
		<title>Search Players</title>
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Configurações de Time da Search Players">
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

						$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con=mysqli_fetch_array($resul);

						if(mysqli_num_rows($resul)){
							?>
							<section class="col-md-9">
								<h1 class="text-title">Configurar Time</h1>
								<p class="text">As seguintes informações estaram amostra em seu perfil para outros usuários</p>
								<form name="editar" method="POST" action="#" id="altera_form" enctype="multipart/form-data">

									<div class="form-group">
										<div class="input-group mb-3">
										  	<div class="custom-file">
										    	<input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="inputGroupFileAddon03">
										    	<label class="custom-file-label" for="foto">
										    		Adicione um Brasão
										    	</label>
										 	 </div>
										</div>

										<figure>
											<?php
												$foto=1;
												include('foto_time.php'); 
											?>
										</figure>

										<?php
											if(!empty($con['foto_time'])){
												?>
													<a href="retira_foto_t.php">
														<button type="button" class="btn btn-danger">
															Retirar Foto
														</button>
													</a>
												<?php
											}
										?>
									</div>

									<div class="form-group row">
										<div class="col-md-6">
											<label for="nome">
												Nome
											</label>
											<input class="form-control" type="text" name="nome" value=<?php echo('"'.$con['nome'].'"'); ?>>
										</div>							
									</div>

									<div class="form-group">
										<label for="lema">
											Lema
										</label>
										<textarea class="form-control" style="resize: none" id="lema" name="lema" row="3"><?php echo($con['lema']); ?></textarea>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<label for="cep">
												CEP
											</label>
											<input class="form-control" name="cep" type="text" id="cep" size=10 placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" value=<?php if(isset($con['cep_sede'])){ echo($con['cep_sede']); } ?>>
										</div>

										<div  class="col-sm-6">
											<label for="uf">
												Estado
											</label>
											<select class="form-control" id="uf" name="uf">
												<option value="AC" <?php if($con['uf_sede']=="AC"){ echo('selected'); }?>>Acre</option>
												<option value="AL"<?php if($con['uf_sede']=="AL"){ echo('selected'); }?>>Alagoas</option>
												<option value="AP"<?php if($con['uf_sede']=="AP"){ echo('selected'); }?>>Amapá</option>
												<option value="AM"<?php if($con['uf_sede']=="AM"){ echo('selected'); }?>>Amazonas</option>
												<option value="BA"<?php if($con['uf_sede']=="BA"){ echo('selected'); }?>>Bahia</option>
												<option value="CE"<?php if($con['uf_sede']=="CE"){ echo('selected'); }?>>Ceará</option>
												<option value="DF"<?php if($con['uf_sede']=="DF"){ echo('selected'); }?>>Distrito Federal</option>
												<option value="ES"<?php if($con['uf_sede']=="ES"){ echo('selected'); }?>>Espírito Santo</option>
												<option value="GO"<?php if($con['uf_sede']=="GO"){ echo('selected'); }?>>Goiás</option>
												<option value="MA"<?php if($con['uf_sede']=="MA"){ echo('selected'); }?>>Maranhão</option>
												<option value="MT"<?php if($con['uf_sede']=="MT"){ echo('selected'); }?>>Mato Grosso</option>
												<option value="MS"<?php if($con['uf_sede']=="MS"){ echo('selected'); }?>>Mato Grosso do Sul</option>
												<option value="MG"<?php if($con['uf_sede']=="MG"){ echo('selected'); }?>>Minas Gerais</option>
												<option value="PA"<?php if($con['uf_sede']=="PA"){ echo('selected'); }?>>Pará</option>
												<option value="PB"<?php if($con['uf_sede']=="PB"){ echo('selected'); }?>>Paraíba</option>
												<option value="PR"<?php if($con['uf_sede']=="PR"){ echo('selected'); }?>>Paraná</option>
												<option value="PE"<?php if($con['uf_sede']=="PE"){ echo('selected'); }?>>Pernambuco</option>
												<option value="PI"<?php if($con['uf_sede']=="PI"){ echo('selected'); }?>>Piauí</option>
												<option value="RJ"<?php if($con['uf_sede']=="RJ"){ echo('selected'); }?>>Rio de Janeiro</option>
												<option value="RN"<?php if($con['uf_sede']=="RN"){ echo('selected'); }?>>Rio Grande do Norte</option>
												<option value="RS"<?php if($con['uf_sede']=="RS"){ echo('selected'); }?>>Rio Grande do Sul</option>
												<option value="RO"<?php if($con['uf_sede']=="RO"){ echo('selected'); }?>>Rondônia</option>
												<option value="RR"<?php if($con['uf_sede']=="RR"){ echo('selected'); }?>>Roraima</option>
												<option value="SC"<?php if($con['uf_sede']=="SC"){ echo('selected'); }?>>Santa Catarina</option>
												<option value="SP"<?php if($con['uf_sede']=="SP"){ echo('selected'); }?>>São Paulo</option>
												<option value="SE"<?php if($con['uf_sede']=="SE"){ echo('selected'); }?>>Sergipe</option>
												<option value="TO"<?php if($con['uf_sede']=="TO"){ echo('selected'); }?>>Tocantins</option>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<label for="cidade">
									        	Cidade
											</label>
											<input class="form-control" name="cidade" type="text" id="cidade" placeholder="Cidade" size="40" value=<?php if(isset($con['cidade_sede'])){ echo($con['cidade_sede']); } ?>>
										</div>

										<div class="col-sm-6">
									        <label for="bairro">
									        	Bairro
									        </label>
											<input class="form-control" name="bairro" type="text" id="bairro" placeholder="Bairro" size="40" value=<?php if(isset($con['bairro_sede'])){ echo($con['bairro_sede']); } ?>>
										</div>

										<div class="col-sm-6">
									        <label for="rua">
									        	Rua
									        </label>
											<input class="form-control" name="rua" type="text" id="rua" placeholder="Rua" size="40" value=<?php if(isset($con['rua_sede'])){ echo('"'.$con['rua_sede'].'"'); } ?>>
										</div>

										<div class="col-sm-6">
									        <label for="numero">
									        	Nº							    
									        </label>
											<input class="form-control" name="numero" type="text" id="numero" placeholder="Numero" size="40" value=<?php if(isset($con['numero_sede'])){ echo($con['numero_sede']); } ?>>
										</div>
									</div>

									<button class="btn btn-light" type="button" name="salvar" data-toggle="modal" data-target="#alterar_usuario">
										Salvar Alterações
									</button>
									<a href="meu_time.php">
										<button class="btn btn-danger" type="button">Cancelar</button> 
									</a>

									<a href="excluir_time">
										<button class="btn btn-danger" type="button">Fechar Time</button>
									</a>	
							</section>
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
							        <input type="submit" name="alterar" value="Alterar" class="btn btn-primary" data-toggle="modal" data-target="#resposta_alterar">
								</form>
							    </div>
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
					     				<a href="meu_time.php">
								        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
								        </a>
								    </div>
								</div>
							</div>
						</div>						
					</section>

					<?php
					if(isset($_POST['alterar'])){

						$sqlbu='select senha from usuario where id_usuario='.$_SESSION['id_usuario'].';';

						$resul=mysqli_query($conexao, $sqlbu);

						$con=mysqli_fetch_array($resul);

						if(sha1(trim($_POST['senha']))==$con['senha']){
							$nome=$_POST['nome'];
							$lema=$_POST['lema'];
							$foto=$_FILES['foto'];
							$cep=$_POST['cep'];

							if(!empty($cep)){
								$uf=$_POST['uf'];
								$cidade=$_POST['cidade'];
								$bairro=$_POST['bairro'];
								$rua=$_POST['rua'];
								$numero=$_POST['numero'];

								$sqlalt='update times set cep_sede="'.$cep.'", uf_sede="'.$uf.'", cidade_sede="'.$cidade.'", bairro_sede="'.$bairro.'", rua_sede="'.$rua.'", numero_sede="'.$numero.'" where id_dono='.$_SESSION['id_usuario'].';';

								$alterar=mysqli_query($conexao, $sqlalt);
							}

							if(!empty($foto['name'])){
								$largura=15;
								$altura=1500;
								$tamanho=2018000;

								if(!preg_match("/^image\/(jpg|jpeg|gif|bmp|png|webp|svg)$/", $foto['type'])){

									echo('<script>window.alert("Não é uma imagem!"); window.location="config_time.php"; </script>');

								}else{

									$dimensoes=getimagesize($foto["tmp_name"]);

									if($dimensoes[0]>$largura){
										echo('<script>window.alert("A largura da imagem não pode ultrapassar '.$largura.' pixels!"); window.location="config_time.php"; </script>');
									}else{

										if($dimensoes[1]>$altura){
											echo('<script>window.alert("A altura da imagem não pode ultrapassar '.$altura.' pixels!"); window.location="config_time.php"; </script>');
										}else{

											if($foto['size']>$tamanho){
												echo('<script>window.alert("O tamanho da imagem não pode ultrapassar '.$tamanho.' bites!"); window.location="config_time.php"; </script>');
											}else{

												preg_match("/\.(jpg|jpeg|gif|bmp|png|webp|svg){1}$/i", $foto['name'], $ext);

												$nome_foto=md5(uniqid(time())).'.'.$ext[1];

												$caminho_imagem='img/foto_time/'.$nome_foto;

												move_uploaded_file($foto['tmp_name'], $caminho_imagem);

												$sqlalt='update times set foto_time="'.$nome_foto.'" where id_dono='.$_SESSION['id_usuario'].';';

												$alterar_foto=mysqli_query($conexao, $sqlalt);

												if($alterar_foto){
													echo(unlink('img/foto_time/'.$con['foto_time']));
												}
											}
										}
									}
								}
							}

							$sqlalt='update times set nome="'.$nome.'", lema="'.$lema.'" where id_dono='.$_SESSION['id_usuario'].';';

							$alterar=mysqli_query($conexao, $sqlalt);

							if($alterar){													
								?>	
								<script type="text/javascript">
									$(document).ready(function(){
										$('#alteracao_completa').modal('show');				
									});
								</script>
								<?php

							}else{
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
				include('footer2.php');
			?>
		</main>

		<!--scripts-->
		<script type="text/javascript" src="./js/alterar.js"></script>
	</body>
</html>
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
			<?php
				if(isset($_GET['info'])){

					$id_camp=$_GET['id_camp'];

					$sqlbu='select * from campeonatos where id_campeonato='.$id_camp.';';

					$resul=mysqli_query($conexao, $sqlbu);

					if(mysqli_num_rows($resul)){

						$con_camp=mysqli_fetch_array($resul);

						if($_SESSION['id_usuario']==$con_camp['id_org']){ 
							?>
							<section class="container">
							<form name="form_alterar" method="POST" action="#" enctype="multipart/form-data">

								<div class="custom-file">
									<input class="custom-file-input"type="file" id="foto" name="foto">
									<label class="custom-file-label" for="foto">Banner do Campenato</label>
								</div>
								<figure>
									<?php
										$foto=3;
										include('foto_camp.php'); 
									?>
								</figure>

								<?php
									if(!empty($con_camp['foto'])){
										?>
										<div class="mx auto" style="width:200px;">
											<a href="retira_foto_c.php?id_camp=<?php echo($id_camp); ?>">
												<button class="btn btn-danger" type="button">
													Retirar Foto
												</button>
											</a>
										<?php
									}
								?>
								</div>
								<div class="form-group">
      								<label for="nome">Nome do Campeonato</label>
      								<input class="form-control" type="text" name="nome_camp" id="nome" value=<?php echo('"'.$con_camp['nome'].'"') ?>>
      							</div>

      							<div class="form-group">
      								<label for="data_i">Data de Inicio</label>
      								<input class="form-control" type="date" name="data_i" id="data_i" value=<?php echo($con_camp['d_termino']) ?>>
      							</div>

      							<div class="form-group">
      								<label for="data_t">Data de Termino</label>
      								<input class="form-control" type="date" name="data_t" id="data_t" value=<?php echo($con_camp['d_inicio']) ?>>
      							</div>

      							<div class="form-group">
      								<label for="quantidade">Quantidade de Times</label>
      								<input class="form-control" type="number" name="quantidade" id="quantidade" value=<?php echo($con_camp['n_times']) ?>>
      							</div>

      							<div class="form-group">
      								<label for="premio">Premiação</label>
      								<input class="form-control" type="text" name="premio" id="premio" value=<?php echo('"'.$con_camp['premiacao'].'"') ?>>
      							</div>

      							<div class="form-group">
      								<label for="taxa">Taxa de Inscrição</label>
      								<input class="form-control" type="text" name="taxa" id="taxa" value=<?php echo($con_camp['taxa_inscricao']) ?>>
      							</div>

								<label for="cep">
									CEP
								</label>
								<input class="form-control" name="cep" type="text" id="cep" size=10 placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" value=<?php echo($con_camp['cep']) ?>>

								<label for="uf">
									Estado
								</label>
								<select class="form-control" id="uf" name="uf">
									<option value="AC" <?php if($con_camp['estado']=="AC"){ echo('selected'); }?>>Acre</option>
									<option value="AL"<?php if($con_camp['estado']=="AL"){ echo('selected'); }?>>Alagoas</option>
									<option value="AP"<?php if($con_camp['estado']=="AP"){ echo('selected'); }?>>Amapá</option>
									<option value="AM"<?php if($con_camp['estado']=="AM"){ echo('selected'); }?>>Amazonas</option>
									<option value="BA"<?php if($con_camp['estado']=="BA"){ echo('selected'); }?>>Bahia</option>
									<option value="CE"<?php if($con_camp['estado']=="CE"){ echo('selected'); }?>>Ceará</option>
									<option value="DF"<?php if($con_camp['estado']=="DF"){ echo('selected'); }?>>Distrito Federal</option>
									<option value="ES"<?php if($con_camp['estado']=="ES"){ echo('selected'); }?>>Espírito Santo</option>
									<option value="GO"<?php if($con_camp['estado']=="GO"){ echo('selected'); }?>>Goiás</option>
									<option value="MA"<?php if($con_camp['estado']=="MA"){ echo('selected'); }?>>Maranhão</option>
									<option value="MT"<?php if($con_camp['estado']=="MT"){ echo('selected'); }?>>Mato Grosso</option>
									<option value="MS"<?php if($con_camp['estado']=="MS"){ echo('selected'); }?>>Mato Grosso do Sul</option>
									<option value="MG"<?php if($con_camp['estado']=="MG"){ echo('selected'); }?>>Minas Gerais</option>
									<option value="PA"<?php if($con_camp['estado']=="PA"){ echo('selected'); }?>>Pará</option>
									<option value="PB"<?php if($con_camp['estado']=="PB"){ echo('selected'); }?>>Paraíba</option>
									<option value="PR"<?php if($con_camp['estado']=="PR"){ echo('selected'); }?>>Paraná</option>
									<option value="PE"<?php if($con_camp['estado']=="PE"){ echo('selected'); }?>>Pernambuco</option>
									<option value="PI"<?php if($con_camp['estado']=="PI"){ echo('selected'); }?>>Piauí</option>
									<option value="RJ"<?php if($con_camp['estado']=="RJ"){ echo('selected'); }?>>Rio de Janeiro</option>
									<option value="RN"<?php if($con_camp['estado']=="RN"){ echo('selected'); }?>>Rio Grande do Norte</option>
									<option value="RS"<?php if($con_camp['estado']=="RS"){ echo('selected'); }?>>Rio Grande do Sul</option>
									<option value="RO"<?php if($con_camp['estado']=="RO"){ echo('selected'); }?>>Rondônia</option>
									<option value="RR"<?php if($con_camp['estado']=="RR"){ echo('selected'); }?>>Roraima</option>
									<option value="SC"<?php if($con_camp['estado']=="SC"){ echo('selected'); }?>>Santa Catarina</option>
									<option value="SP"<?php if($con_camp['estado']=="SP"){ echo('selected'); }?>>São Paulo</option>
									<option value="SE"<?php if($con_camp['estado']=="SE"){ echo('selected'); }?>>Sergipe</option>
									<option value="TO"<?php if($con_camp['estado']=="TO"){ echo('selected'); }?>>Tocantins</option>
								</select>
							
								<label for="cidade">
						        	Cidade
								</label>
								<input class="form-control" name="cidade" type="text" id="cidade" placeholder="Cidade" size="40" value=<?php echo($con_camp['cidade']) ?>>
								<fieldset class="form-group">
								<legend>
									Esporte
								</legend>
								<div class="form-check">
									<input type="radio" name="esporte" value='1' id="fult" <?php if($con_camp['tipo']==1){ echo('checked'); }?>>
									<label for="fult">
										Fultebol
									</label>
								</div>
								<div class="form-check">
									<input type="radio" name="esporte" value='2' id="bask" <?php if($con_camp['tipo']==2){ echo('checked'); }?>>
									<label for="bask">
										Basquete
									</label>
								</div>
								<div class="form-check">
									<input type="radio" name="esporte" value='3' id="volei" <?php if($con_camp['tipo']==3){ echo('checked'); }?>>
									<label for="volei">
										Volei
									</label>
								</div>
								</fieldset>
								<fieldset class="form-group">
									<legend>
										Tipo do Campeonato
									</legend>
									<div class="form-check">
										<input type="radio" name="tipo" value="1" id="1" <?php if($con_camp['tipo']==1){ echo('checked'); }?>>
										<label for="1">
											Fechado (Só entram os times que você chamar)
										</label>
									</div>
									<div class="form-check">
										<input type="radio" name="tipo" value="2" id="2" <?php if($con_camp['tipo']==2){ echo('checked'); }?>>
										<label for="2">
											Somente com permissão
										</label>
									</div>
									<div class="form-check">
										<input type="radio" name="tipo" value="3" id="3" <?php if($con_camp['tipo']==3){ echo('checked'); }?>>
										<label for="3">
											Aberto a todos
										</label>
									</div>
								</fieldset>

								<a class="btn btn-danger" style="background:#fff; color:#000;" href="pagina_camp.php?info=true&id_camp=<?php echo($id_camp)?>">
									
		    							Cancelar	
		    					</a>

	    						<input class="btn btn-danger" style="background:#ff3c00; color:#000;" name="alterar" value="Alterar" type="submit"/>

	    						<input class="btn btn-danger" style="background:#ff3c00; color:#000;" name="excluir" value="Excluir Campeonato" type="submit"/>

							</form>
						</section>
							<?php

							if(isset($_POST['excluir'])){

								$sqlex='delete from campeonatos where id_campeonato='.$id_camp.';';

								$excluir=mysqli_query($conexao, $sqlex);

								if($excluir){
									echo('<script> window.location="camp.php"; </script>');
								}
							}

							if(isset($_POST['alterar'])){
								$nome=$_POST['nome_camp'];
								$n_times=$_POST['quantidade'];
								$d_inicio=$_POST['data_i'];
								$d_termino=$_POST['data_t'];
								$taxa=$_POST['taxa'];
								$cep=$_POST['cep'];
								$cidade=$_POST['cidade'];
								$estado=$_POST['uf'];
								$premiacao=$_POST['premio'];
								$tipo=$_POST['tipo'];
								$foto=$_FILES['foto'];

								if(!empty($foto['name'])){
								$largura=1500;
								$altura=1500;
								$tamanho=2018000;



									if(!preg_match("/^image\/(jpg|jpeg|gif|bmp|png|webp|svg)$/", $foto['type'])){
										echo('<script>window.alert("Não é uma imagem!"); window.location="config_camp.php?info=true&id_camp='.$id_camp.'"; </script>');

									}else{

										$dimensoes=getimagesize($foto["tmp_name"]);

										if($dimensoes[0]>$largura){
											echo('<script>window.alert("A largura da imagem não pode ultrapassar '.$largura.' pixels!"); window.location="config_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
										}else{

											if($dimensoes[1]>$altura){
												echo('<script>window.alert("A altura da imagem não pode ultrapassar '.$altura.' pixels!"); window.location="config_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
											}else{

												if($foto['size']>$tamanho){
													echo('<script>window.alert("O tamanho da imagem não pode ultrapassar '.$tamanho.' bites!"); window.location="config_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
												}else{

													preg_match("/\.(jpg|jpeg|gif|bmp|png|webp|svg){1}$/i", $foto['name'], $ext);

													$nome_foto=md5(uniqid(time())).'.'.$ext[1];

													$caminho_imagem='img/foto_camps/'.$nome_foto;

													move_uploaded_file($foto['tmp_name'], $caminho_imagem);

													$sqlalt='update campeonatos set foto="'.$nome_foto.'" where id_campeonato='.$id_camp.';';

													$alterar_foto=mysqli_query($conexao, $sqlalt);

													if($alterar_foto){

														echo(unlink('img/foto_camps/'.$con_camp['foto']));
													}
												}
											}
										}
									}
								}

								$sqlalt='update campeonatos set nome="'.$nome.'", n_times='.$n_times.', d_inicio="'.$d_inicio.'", d_termino="'.$d_termino.'", taxa_inscricao='.$taxa.', cep="'.$cep.'", cidade="'.$cidade.'", estado="'.$estado.'", premiacao="'.$premiacao.'", tipo='.$tipo.' where id_campeonato='.$id_camp.';';

								$alterar=mysqli_query($conexao, $sqlalt);

								if($alterar){
									echo('<script> window.location="pagina_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
								}
							}

						}else{
							echo('voce não é o organizador desse campeonato');
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
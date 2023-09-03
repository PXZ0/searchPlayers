<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
	$pagina=2;
	include('formatar_data.php');
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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
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
		<?php
			include('header.php');
		?>
		<main>
			<?php
				if(isset($_GET['info'])){
					$id_time1=$_GET['id_envio'];
					$id_time2=$_GET['id_recebi'];

					$sqlbu='select * from partidas where id_time1='.$id_time1.' and id_time2='.$id_time2.';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con=mysqli_fetch_array($resul);


					$sqlbu='select * from times where id_time='.$id_time1.';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con_time1=mysqli_fetch_array($resul);


					$sqlbu='select * from times where id_time='.$id_time2.';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con_time2=mysqli_fetch_array($resul);


					$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

					$resul=mysqli_query($conexao, $sqlbu);

					$con_meu_time=mysqli_fetch_array($resul);

					if($con_meu_time['id_time']==$id_time1 || $con_meu_time['id_time']==$id_time2){

						if($con['status']==0 || $con['status']==1){

							?>
							<section class="container">
								<figure class="mx-auto" style="width:450px;">
									<img style="width:450px;" src="./img/aceitar_partida.svg">
								</figure>
								<?php
									echo(' <p class="text-center text_mensagem">
										
											O '.$con_time1['nome'].' deseja marcar uma partida com o seu time, o jogo será, caso aceite, em '.$con['estado_part'].' na cidade de '.$con['cidade_part'].', no bairro '.$con['bairro_part'].', nx '.$con['rua_part'].', número '.$con['numero_part'].'.
									</p>');

								?>
								<p class="text-center text_mensagem">
									A partida será no dia <?php echo(formatarData($con['data'])); ?>, às <?php echo(formatarHora($con['hora'])); ?> no horário de Brasília.
								</p>
								<div class='text-center'>

									<form class="mx-auto" style="width:100px;" name="form_confirmar" method="POST" action="#">
										<input class="btn btn-light" style="background:#ff3c00" type="submit" name="aceitar" value="Aceitar Partida">
									</form>

								
									<button type="button" class="btn btn-light"  data-toggle="modal" data-target="#contra_proposta">
										Mudar algo
									</button>
								</div>							

							</section>

							<!-- Modal-Marcar Partida-->
							<form name="form_contra" method="POST" action="#">
								<div class="modal fade" id="contra_proposta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								    <div class="modal-dialog">
								    	<div class="modal-content">
								      		<div class="modal-header">
								        		<h5 class="modal-title" id="exampleModalLabel">Marcar Partida</h5>
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        			<span aria-hidden="true">&times;</span>
								        		</button>
								     		</div>
									      	<div class="modal-body">	

												<h5>
													Local da Partida
												</h5>

												<div class="form-group row">
													<div class="col-sm-6">
														<label for="cep">
															CEP
														</label>
														<input class="form-control" name="cep" type="text" id="cep" size=10 placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" value=<?php if(isset($con['cep_part'])){ echo($con['cep_part']); } ?>>
													</div>

													<div  class="col-sm-6">
														<label for="uf">
															Estado
														</label>
														<select class="form-control" id="uf" name="uf">
															<option value="AC" <?php if($con['estado_part']=="AC"){ echo('selected'); }?>>Acre</option>
															<option value="AL"<?php if($con['estado_part']=="AL"){ echo('selected'); }?>>Alagoas</option>
															<option value="AP"<?php if($con['estado_part']=="AP"){ echo('selected'); }?>>Amapá</option>
															<option value="AM"<?php if($con['estado_part']=="AM"){ echo('selected'); }?>>Amazonas</option>
															<option value="BA"<?php if($con['estado_part']=="BA"){ echo('selected'); }?>>Bahia</option>
															<option value="CE"<?php if($con['estado_part']=="CE"){ echo('selected'); }?>>Ceará</option>
															<option value="DF"<?php if($con['estado_part']=="DF"){ echo('selected'); }?>>Distrito Federal</option>
															<option value="ES"<?php if($con['estado_part']=="ES"){ echo('selected'); }?>>Espírito Santo</option>
															<option value="GO"<?php if($con['estado_part']=="GO"){ echo('selected'); }?>>Goiás</option>
															<option value="MA"<?php if($con['estado_part']=="MA"){ echo('selected'); }?>>Maranhão</option>
															<option value="MT"<?php if($con['estado_part']=="MT"){ echo('selected'); }?>>Mato Grosso</option>
															<option value="MS"<?php if($con['estado_part']=="MS"){ echo('selected'); }?>>Mato Grosso do Sul</option>
															<option value="MG"<?php if($con['estado_part']=="MG"){ echo('selected'); }?>>Minas Gerais</option>
															<option value="PA"<?php if($con['estado_part']=="PA"){ echo('selected'); }?>>Pará</option>
															<option value="PB"<?php if($con['estado_part']=="PB"){ echo('selected'); }?>>Paraíba</option>
															<option value="PR"<?php if($con['estado_part']=="PR"){ echo('selected'); }?>>Paraná</option>
															<option value="PE"<?php if($con['estado_part']=="PE"){ echo('selected'); }?>>Pernambuco</option>
															<option value="PI"<?php if($con['estado_part']=="PI"){ echo('selected'); }?>>Piauí</option>
															<option value="RJ"<?php if($con['estado_part']=="RJ"){ echo('selected'); }?>>Rio de Janeiro</option>
															<option value="RN"<?php if($con['estado_part']=="RN"){ echo('selected'); }?>>Rio Grande do Norte</option>
															<option value="RS"<?php if($con['estado_part']=="RS"){ echo('selected'); }?>>Rio Grande do Sul</option>
															<option value="RO"<?php if($con['estado_part']=="RO"){ echo('selected'); }?>>Rondônia</option>
															<option value="RR"<?php if($con['estado_part']=="RR"){ echo('selected'); }?>>Roraima</option>
															<option value="SC"<?php if($con['estado_part']=="SC"){ echo('selected'); }?>>Santa Catarina</option>
															<option value="SP"<?php if($con['estado_part']=="SP"){ echo('selected'); }?>>São Paulo</option>
															<option value="SE"<?php if($con['estado_part']=="SE"){ echo('selected'); }?>>Sergipe</option>
															<option value="TO"<?php if($con['estado_part']=="TO"){ echo('selected'); }?>>Tocantins</option>
														</select>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-6">
														<label for="cidade">
												        	Cidade
														</label>
														<input class="form-control" name="cidade" type="text" id="cidade" placeholder="Cidade" size="40" value=<?php if(isset($con['cidade_part'])){ echo($con['cidade_part']); } ?>>
													</div>

													<div class="col-sm-6">
												        <label for="bairro">
												        	Bairro
												        </label>
														<input class="form-control" name="bairro" type="text" id="bairro" placeholder="Bairro" size="40" value=<?php if(isset($con['bairro_part'])){ echo($con['bairro_part']); } ?>>
													</div>

													<div class="col-sm-6">
												        <label for="rua">
												        	Rua
												        </label>
														<input class="form-control" name="rua" type="text" id="rua" placeholder="Rua" size="40" value=<?php if(isset($con['rua_part'])){ echo('"'.$con['rua_part'].'"'); } ?>>
													</div>

													<div class="col-sm-6">
												        <label for="numero">
												        	Nº							    
												        </label>
														<input class="form-control" name="numero" type="text" id="numero" placeholder="Numero" size="40" value=<?php if(isset($con['numero_part'])){ echo($con['numero_part']); } ?>>
													</div>
												</div>
											</div>
											
											<fieldset class="form-group">

												<legend>
													Tipo de partida
												</legend>

												<div class="form-check">
													<input type="radio" name="tipo" value="1" id="amistosa" <?php if($con['tipo']==1){ echo('checked'); }?>>
													<label for="amistosa">
														Amistosa
													</label>
												</div>

												<div class="form-check">
													<input type="radio" name="tipo" value="2" id="rankeada" <?php if($con['tipo']==2){ echo('checked'); }?>>
													<label for="rakeada">
														Rankeada
													</label>
												</div>
											</fieldset>

											<fieldset>

												<legend>
													Data e Hora
												</legend>

												<label for="data_part">
													Data da Partida
												</label>
												<input class="form-control" type="date" name="data_part" id="data_part" value=<?php if(isset($con['data'])){ echo($con['data']); } ?>>

												<label for="hora_part">
													Hora da partida
												</label>
												<input class="form-control" type="time" name="hora_part" id="hora_part" id="hora_part" value=<?php if(isset($con['hora'])){ echo($con['hora']); } ?>>
											</fieldset>

							     			<div class="modal-footer">

										        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

										        <input class="btn btn-light" style="background:#ff3c00" type="submit" name="contra" value="Enviar Contraproposta">	    
										    </div>
										</div>
									</div>
								</div>
							</form>

							<?php
							if(isset($_POST['contra'])){
								$data=$_POST['data_part'];
								$hora=$_POST['hora_part'];
								$cep=$_POST['cep'];
								$estado=$_POST['uf'];
								$cidade=$_POST['cidade'];
								$rua=$_POST['rua'];
								$numero=$_POST['numero'];
								$tipo=$_POST['tipo'];

								$sqlalt='update partidas set id_time1='.$id_time2.', id_time2='.$id_time1.',  data="'.$data.'", hora="'.$hora.'", cep_part="'.$cep.'", estado_part="'.$estado.'", cidade_part="'.$cidade.'", rua_part="'.$rua.'", numero_part="'.$numero.'", tipo='.$tipo.', status=1 where id_partida='.$con['id_partida'].';';

								echo($sqlalt);

								$alterar=mysqli_query($conexao, $sqlalt);

								if($alterar){

									if($con_meu_time['id_time']==$id_time1){

										$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con_time2['id_dono'].', "'.$_SESSION['nome'].' do time '.ucwords($con_meu_time['nome']).' te enviou uma nova proposta de partida com o seu time", 0, "proposta_partida.php?info=true&id_envio='.$id_time1.'&id_recebi='.$id_time2.'");';

									}else{

										$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con_time1['id_dono'].', "'.$_SESSION['nome'].' do time '.ucwords($con_meu_time['nome']).' te enviou uma nova proposta de partida com o seu time", 0, "proposta_partida.php?info=true&id_envio='.$id_time2.'&id_recebi='.$id_time1.'");';
									}
							
									$inserir=mysqli_query($conexao, $sqlin);

									if($inserir){
										if($con_meu_time['id_time']==$id_time1){
											echo('<script> window.location="pagina_time.php?info=true&id_time='.$id_time2.'"; </script>');
										}else{
											echo('<script> window.location="pagina_time.php?info=true&id_time='.$id_time1.'"; </script>');
										}
									}
								}
							}

							if(isset($_POST['aceitar'])){
								$sqlalt='update partidas set status=2 where id_partida='.$con['id_partida'].';';

								$alterar=mysqli_query($conexao, $sqlalt);

								if($alterar){
									echo('<script> window.location="minhas_partidas.php"; </script>');
								}
							}
						}else{
							?>
							
							<section class="d-flex align-items-center flex-column">
								<figure class="mx-auto" style="width: 400px;">
									<img class="sem_proposta" style="width: 400px;" src="./img/sem_proposta">
								</figure>
								<p class="text-center text_mensagem">
									Você já não tem nenhuma proposta de partida com esse time!
								</p>
							

							<a href=index.php>
								<button type='button' style="background-color:#ff3c00;" class="btn btn-danger">Voltar</button>
							</a>
							</section>
							<?php
						}
					}else{
						?>
						<section class="d-flex align-items-center flex-column">
							<figure class="mx-auto" style="width: 400px;">
								<img class="sem_time" style="width: 400px;" src="./img/sem_proposta">
							</figure>
							<p class="text-center text_mensagem">
								Você não é dono de nenhum desses times!!!
							</p>
						

						<a href=index.php>
							<button type='button' style="background-color:#ff3c00;" class="btn btn-danger">Voltar</button>
						</a>
						</section>
						<?php
					}
				}
			?>
		</main>

		<!-- Rodapé -->
		<?php 
			include('footer.php');
		?>
	</body>
</html>
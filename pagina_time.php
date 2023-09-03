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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/main.css">
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
			<section class="d-flex align-items-center flex-column">
				<?php
					if(isset($_GET['info'])){					
						$id_time=$_GET['id_time'];

						$sqlbu='select * from times where id_time='.$id_time.';';

						$resul=mysqli_query($conexao, $sqlbu);

						if($resul){

							$con=mysqli_fetch_array($resul);

							if($_SESSION['tipo_usuario']==2){

								$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

								$resul_meu_time=mysqli_query($conexao, $sqlbu);

								if(mysqli_num_rows($resul_meu_time)){

									$con_meu_time=mysqli_fetch_array($resul_meu_time);

									if($con_meu_time['id_time']==$id_time){
										echo('<script> window.location="meu_time.php"; </script>');
									}
								}
							}
							
							$foto=1;
							include('foto_time.php');

							?>

							<h5 class="titulo">
								<?php
									echo($con['nome']);
								?>
							</h5>

							<div class="card mb-3 mx-auto" style="width:600px; padding:10px; background-color: #222;">
							<p style="text-align:center;" class="text_mensagem text-break">
								Esporte:
								<?php
									switch ($con['id_esportes']){
										case 1:
											echo('Futebol');
										break;

										case 2:
											echo('Basquete');
										break;

										case 3:
											echo('Volei');
										break;

										default:
											echo('Esse esporte não existe');
										break;
									}
								?>
							</p>
							<?php
								if (!empty($con['lema'])) {
							?>
								<p style="font-style:italic; text-align:center;" class="text_mensagem text-break">
							<?php
										echo('"'.$con['lema'].'"');
								}
							?>
								</p>
								<p style="text-align:center;" class="text_mensagem text-break">
							<?php
								if(isset($con['cep_sede'])){
									echo($con['cidade_sede'].' - '.$con['uf_sede'].' ');
									echo($con['rua_sede'].' Nº '.$con['numero_sede']);
								}
							?>
								</p> 
						</div>
							
							<?php

							$sqlbu='select * from campeonatos where id_org='.$_SESSION['id_usuario'].' and nome_org="'.$_SESSION['nome'].'";';

							$resul=mysqli_query($conexao, $sqlbu);

							if(mysqli_num_rows($resul)){

								$con_camp=mysqli_fetch_array($resul);

								$sqlbu='select * from notifica where notifi="O campeonato '.$con_camp['nome'].' está querendo que você participe dele" and id_usu='.$_SESSION['id_usuario'].' and id_para='.$con['id_dono'].' ;';

								$resul=mysqli_query($conexao, $sqlbu);

								if(!mysqli_num_rows($resul)){
									?>
										<form action="#" method="POST">
											<input type="submit" class="btn btn-danger" style="background-color:#ff6535;" name="convidar" value='Convidar time para o <?php echo($con_camp['nome']);?>'>
										</form>
									<?php
								}else{

									$con_notifi=mysqli_fetch_array($resul);

									?>
									<form action="#" method="POST">
										<input type="submit" class="btn btn-danger" style="background-color:#ff6535;" name="cancelar_convite" value='Cancelar convite para o <?php echo($con_camp['nome']);?>'>
									</form>
									<?php
								}

								if(isset($_POST['cancelar_convite'])){
									$sqlex='delete from notifica where id_notifica='.$con_notifi['id_notifica'].';';

									$excluir=mysqli_query($conexao, $sqlex);

									if($excluir){
										echo('<script> window.location="pagina_time.php?info=true&id_time='.$id_time.'"; </script>');
									}
								}

								if(isset($_POST['convidar'])){

									$sqlin='insert into notifica (id_usu, id_para, notifi, link) values('.$_SESSION['id_usuario'].', '.$con['id_dono'].', "O campeonato '.$con_camp['nome'].' está querendo que você participe dele", "pagina_camp.php?info=true&id_camp='.$con_camp['id_campeonato'].'");';

									$inserir=mysqli_query($conexao, $sqlin);

									if($inserir){
										echo('<script> window.location="pagina_time.php?info=true&id_time='.$id_time.'"; </script>');
									}
								}
							}

							if(isset($_GET['id_camp'])){
								$id_camp=$_GET['id_camp'];

								$sqlbu='select * from campeonatos where id_campeonato='.$id_camp.' and id_org='.$_SESSION['id_usuario'].';';

								$resul=mysqli_query($conexao, $sqlbu);

								if(mysqli_num_rows($resul)){

									?>
										<form action="#" method="POST">
											<input type="submit" name="aceitar" value="Aceitar">
										</form>
									<?php

									if(isset($_POST['aceitar'])){
										$sqlalt='update times_camp set status=1 where id_camp='.$id_camp.' and id_time='.$id_time.';';

										$alterar=mysqli_query($conexao, $sqlalt);

										if($alterar){
											echo('<script> window.location="pagina_camp.php?info=true&id_camp='.$id_camp.'"; </script>');
										}
									}
								}
							}

							if($_SESSION['tipo_usuario']==1){

								$sqlbu='select * from contrato where id_jogador='.$_SESSION['id_usuario'].' and id_contratante='.$con['id_dono'].';';

								$resul=mysqli_query($conexao, $sqlbu);

								$con_contrato=mysqli_fetch_array($resul);

								if(!mysqli_num_rows($resul)){

									$esporte_usuario='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
									$consulta=mysqli_query($conexao, $esporte_usuario);
									$con_esporte=mysqli_fetch_array($consulta);
									if(mysqli_num_rows($consulta)){

									?>	
										<form name="entrar_no_time" method="POST" action="proposta_contrato">
											<input type="hidden" name="id_contratante" value=<?php echo($con['id_dono']); ?>>
											<?php
											if(!empty($con_esporte['esporte']) and $con['id_esportes']==$con_esporte['esporte']){
											?>
												<input class="btn btn-danger" style="background-color:#ff6535;" type="submit" name="contratar" value="Enviar proposta ao Time">
											<?php
											}
									}
											?>
										</form>
									<?php

								}else{

									if($con_contrato['status_contrato']==0){

										?>
											<form name="cancelar_pedido" method="POST" action="#">
												<input class="btn btn-light" style="background:#ff6535;" type="submit" name="cancelar" value="Cancelar Proposta">
											</form>
										<?php

									}else{

										?>
										<form name="chat_time" method="POST" action="registrochat_time.php">
											<input type="hidden" name="id_time" value=<?php echo($con['id_time']); ?>>
											<button type="submit" name="conversar_time" class="btn btn-danger" style="background-color:#ff6535;">Chat do Time</button>
										</form>

										<div class="text-center">
											<button type="button" class="btn btn-danger mr-auto" data-toggle="modal" data-target="#sair_time">Sair do Time</button>
										</div>
											<?php

									}
								}
							}

							if($_SESSION['tipo_usuario']==2){

								if(mysqli_num_rows($resul_meu_time)){

									if($con_meu_time['id_esportes']==$con['id_esportes']){
								
										$sqlbu='select * from partidas where id_time1='.$con_meu_time['id_time'].' and id_time2='.$id_time.' and status!=2;';

										$resul_1=mysqli_query($conexao, $sqlbu);

										$con1=mysqli_fetch_array($resul_1);

										$sqlbu='select * from partidas where id_time1='.$id_time.' and id_time2='.$con_meu_time['id_time'].' and status!=2;';						

										$resul_2=mysqli_query($conexao, $sqlbu);

										$con2=mysqli_fetch_array($resul_2);

										if(mysqli_num_rows($resul_1) || mysqli_num_rows($resul_2)){
											?>

											<form action="#" name="partida" method="POST">
												<input type="submit" class="btn btn-danger" name="cancelar_partida" value="Cancelar Partida" />
											</form>

											<?php
										}else{
											?>
												<button type="button" name="marcar" class="btn btn-light"  data-toggle="modal" data-target="#marcar_partida">
													Marcar Partida
												</button>
											<?php
										}
									}
								}
							}
						}
					}
				?>
			</section>

			<section class="container">
				<?php
					$sqlbu='select * from jogadores_time where id_time='.$id_time.' and tipo_jogador=0;';

					$resul=mysqli_query($conexao, $sqlbu);

					if(mysqli_num_rows($resul)){

						$linhas=mysqli_num_rows($resul);
						
						echo('<h1 style="color:#ff3c00"> Jogadores Fixos ('.$linhas.') </h1>');

						while($con_j=mysqli_fetch_array($resul)){

							$sqlbu='select * from usuario where id_usuario='.$con_j['id_jogador'].';';

							$resul_u=mysqli_query($conexao, $sqlbu);

							if(mysqli_num_rows($resul_u)){

								$con_u=mysqli_fetch_array($resul_u);

								$foto=3;
								?>

								<a href="pagina_usuario.php?info=true&id_usuario=<?php echo($con_u['id_usuario']); ?>">
									<p class="text_mensagem">
										<?php
											include('foto_usuario.php');
										?>
									</p>

									<p class="text_mensagem">
										<?php
											echo(ucwords($con_u['nome']));
										?>
									</p>
								</a>

								<?php
							}
						}
					}
				?>
			</section>

			<!--Modais-->

			<!--Modal-Sair do Time-->
			<form name=form-sair method="POST" action="#">
				<section>
					<div class="modal fade" id="sair_time" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					  	<div class="modal-dialog">
					    	<div class="modal-content">
					     		<div class="modal-header">

						        	<h5 class="modal-title" id="staticBackdropLabel">Sair do Time</h5>

						        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          		<span aria-hidden="true">&times;</span>
						        	</button>
						      	</div>

						      	<div class="modal-body">
						        	Deseja mesmo sair do time? Seu técnico será notificado.
						      	</div>

						      	<div class="modal-footer">
					      		
					    			<input name="sair" type="submit" value="Sair" class="btn btn-success">
				    				
						        	<button type="button" data-dismiss="modal" class="btn btn-danger">Não</button>
						      	</div>
						    </div>
					    </div>
					</div>
				</section>
			</form>


			<!--Modal-Saida Completa-->
			<section>
				<div class="modal fade" id="saida_realizada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							       <h5 class="modal-title" id="exampleModalLabel">Saída realizada com sucesso!</h5>
							</div>							     
						    <div class="modal-footer">
						     	<a href="times.php">
									<button type="button" class="btn btn-primary" data-toggle="modal">OK</button>
								</a>
							</div>
						</div>
					</div>
				</div>						
			</section>

			<!-- Modal-Marcar Partida-->
			<form name="marcap" action="#" method="POST">
				<div class="modal fade" id="marcar_partida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										<input class="form-control" name="cep" type="text" id="cep" size=10 placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" value=<?php if(isset($con_meu_time['cep_sede'])){ echo($con_meu_time['cep_sede']); } ?>>
									</div>

									<div  class="col-sm-6">
										<label for="uf">
											Estado
										</label>
										<select class="form-control" id="uf" name="uf">
											<option value="AC" <?php if($con_meu_time['uf_sede']=="AC"){ echo('selected'); }?>>Acre</option>
											<option value="AL"<?php if($con_meu_time['uf_sede']=="AL"){ echo('selected'); }?>>Alagoas</option>
											<option value="AP"<?php if($con_meu_time['uf_sede']=="AP"){ echo('selected'); }?>>Amapá</option>
											<option value="AM"<?php if($con_meu_time['uf_sede']=="AM"){ echo('selected'); }?>>Amazonas</option>
											<option value="BA"<?php if($con_meu_time['uf_sede']=="BA"){ echo('selected'); }?>>Bahia</option>
											<option value="CE"<?php if($con_meu_time['uf_sede']=="CE"){ echo('selected'); }?>>Ceará</option>
											<option value="DF"<?php if($con_meu_time['uf_sede']=="DF"){ echo('selected'); }?>>Distrito Federal</option>
											<option value="ES"<?php if($con_meu_time['uf_sede']=="ES"){ echo('selected'); }?>>Espírito Santo</option>
											<option value="GO"<?php if($con_meu_time['uf_sede']=="GO"){ echo('selected'); }?>>Goiás</option>
											<option value="MA"<?php if($con_meu_time['uf_sede']=="MA"){ echo('selected'); }?>>Maranhão</option>
											<option value="MT"<?php if($con_meu_time['uf_sede']=="MT"){ echo('selected'); }?>>Mato Grosso</option>
											<option value="MS"<?php if($con_meu_time['uf_sede']=="MS"){ echo('selected'); }?>>Mato Grosso do Sul</option>
											<option value="MG"<?php if($con_meu_time['uf_sede']=="MG"){ echo('selected'); }?>>Minas Gerais</option>
											<option value="PA"<?php if($con_meu_time['uf_sede']=="PA"){ echo('selected'); }?>>Pará</option>
											<option value="PB"<?php if($con_meu_time['uf_sede']=="PB"){ echo('selected'); }?>>Paraíba</option>
											<option value="PR"<?php if($con_meu_time['uf_sede']=="PR"){ echo('selected'); }?>>Paraná</option>
											<option value="PE"<?php if($con_meu_time['uf_sede']=="PE"){ echo('selected'); }?>>Pernambuco</option>
											<option value="PI"<?php if($con_meu_time['uf_sede']=="PI"){ echo('selected'); }?>>Piauí</option>
											<option value="RJ"<?php if($con_meu_time['uf_sede']=="RJ"){ echo('selected'); }?>>Rio de Janeiro</option>
											<option value="RN"<?php if($con_meu_time['uf_sede']=="RN"){ echo('selected'); }?>>Rio Grande do Norte</option>
											<option value="RS"<?php if($con_meu_time['uf_sede']=="RS"){ echo('selected'); }?>>Rio Grande do Sul</option>
											<option value="RO"<?php if($con_meu_time['uf_sede']=="RO"){ echo('selected'); }?>>Rondônia</option>
											<option value="RR"<?php if($con_meu_time['uf_sede']=="RR"){ echo('selected'); }?>>Roraima</option>
											<option value="SC"<?php if($con_meu_time['uf_sede']=="SC"){ echo('selected'); }?>>Santa Catarina</option>
											<option value="SP"<?php if($con_meu_time['uf_sede']=="SP"){ echo('selected'); }?>>São Paulo</option>
											<option value="SE"<?php if($con_meu_time['uf_sede']=="SE"){ echo('selected'); }?>>Sergipe</option>
											<option value="TO"<?php if($con_meu_time['uf_sede']=="TO"){ echo('selected'); }?>>Tocantins</option>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-6">
										<label for="cidade">
								        	Cidade
										</label>
										<input class="form-control" name="cidade" type="text" id="cidade" placeholder="Cidade" size="40" value=<?php if(isset($con_meu_time['cidade_sede'])){ echo($con_meu_time['cidade_sede']); } ?>>
									</div>

									<div class="col-sm-6">
								        <label for="bairro">
								        	Bairro
								        </label>
										<input class="form-control" name="bairro" type="text" id="bairro" placeholder="Bairro" size="40" value=<?php if(isset($con_meu_time['bairro_sede'])){ echo($con_meu_time['bairro_sede']); } ?>>
									</div>

									<div class="col-sm-6">
								        <label for="rua">
								        	Rua
								        </label>
										<input class="form-control" name="rua" type="text" id="rua" placeholder="Rua" size="40" value=<?php if(isset($con_meu_time['rua_sede'])){ echo('"'.$con_meu_time['rua_sede'].'"'); } ?>>
									</div>

									<div class="col-sm-6">
								        <label for="numero">
								        	Nº							    
								        </label>
										<input class="form-control" name="numero" type="text" id="numero" placeholder="Numero" size="40" value=<?php if(isset($con_meu_time['numero_sede'])){ echo($con_meu_time['numero_sede']); } ?>>
									</div>
								</div>
							</div>
							
							<fieldset class="form-group">

								<legend>
									Tipo de partida
								</legend>

								<div class="form-check">
									<input type="radio" name="tipo" value="1" id="amistosa">
									<label for="amistosa">
										Amistosa
									</label>
								</div>

								<div class="form-check">
									<input type="radio" name="tipo" value="2" id="rankeada">
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
								<input class="form-control" type="date" name="data_part" id="data_part" />

								<label for="hora_part">
									Hora da partida
								</label>
								<input class="form-control" type="time" name="hora_part" id="hora_part" id="hora_part" />
							</fieldset>

			     			<div class="modal-footer">
						        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						        <input type="submit" name="marcar" value="Marcar Partida" class="btn btn-success">	    
						    </div>
						</div>
					</div>
				</div>
			</form>

			<section>
				<div class="modal fade" id="pedido_enviado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Sua proposta de partida foi enviada!</h5>
				     		</div>
				     		<div class="modal-body">
				     			Sua proposta de partida foi enviada ao outro time, ele poderá confirmar ou recusar, além de enviar uma nova proposta.
				     		</div>				     
			     			<div class="modal-footer">
			     				<a class="link_busca" href="pagina_time.php?info=true&id_time=<?php echo($con['id_time'])?>">
						        	<button type="button" class="btn btn-primary">OK</button>
						        </a>
						    </div>
						</div>
					</div>
				</div>						
			</section>

			<?php
				if(isset($_POST['sair'])){
					echo('isso');

					$sqlex='delete from jogadores_time where id_time="'.$con['id_time'].'" and id_jogador="'.$_SESSION['id_usuario'].'";';

					$excluir=mysqli_query($conexao, $sqlex);

					if($excluir){

						$sqlex='delete from contrato where id_contrato="'.$con_contrato['id_contrato'].'";';

						$excluir=mysqli_query($conexao, $sqlex);

						if($excluir){

							$sqlin='insert into notifica (id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con['id_dono'].', "O jogador '.$_SESSION['nome'].' saiu do seu time.", "meu_time.php");';

							$inserir=mysqli_query($conexao, $sqlin);

							echo('<script>window.location="meus_times.php";</script>');

							if($inserir){
								?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#saida_realizada').modal('show');	
									});
								</script>
								<?php
							} 
						}
					}
				}
			

				if(isset($_POST['marcar'])){
					$data=$_POST['data_part'];
					$hora=$_POST['hora_part'];
					$cep=$_POST['cep'];
					$estado=$_POST['uf'];
					$cidade=$_POST['cidade'];
					$rua=$_POST['rua'];
					$numero=$_POST['numero'];
					$tipo=$_POST['tipo'];

					$sqlin='insert into notifica(id_usu, id_para, notifi, status, link) values('.$_SESSION['id_usuario'].', '.$con['id_dono'].', "'.$_SESSION['nome'].' do time '.ucwords($con_meu_time['nome']).' deseja marcar uma partida com o seu time", 0, "proposta_partida.php?info=true&id_envio='.$con_meu_time['id_time'].'&id_recebi='.$id_time.'");';
					
					$inserir=mysqli_query($conexao, $sqlin);

					if($inserir){

						$sqlin='insert into partidas(data, hora, cep_part, estado_part, cidade_part, rua_part, numero_part, id_time1, id_time2, tipo) values("'.$data.'", "'.$hora.'", "'.$cep.'", "'.$estado.'", "'.$cidade.'", "'.$rua.'", '.$numero.', '.$con_meu_time['id_time'].', '.$id_time.', '.$tipo.');';
					
						$inserir=mysqli_query($conexao, $sqlin);

						if($inserir){
							?>

							<script type="text/javascript">
								$(document).ready(function(){
									$('#pedido_enviado').modal('show');
								});
							</script>
					
							<?php
						}
					}
				}

				if(isset($_POST['cancelar_partida'])){
					$sqlbu_noti='select * from notifica where notifi="'.$_SESSION['nome'].' do time '.ucwords($con_meu_time['nome']).' deseja marcar uma partida com o seu time";';

					$resul_noti=mysqli_query($conexao, $sqlbu_noti);

					$con_noti=mysqli_fetch_array($resul_noti);

					$sqlex= 'delete from notifica where id_notifica ='.$con_noti['id_notifica'].';';

					$excluir=mysqli_query($conexao, $sqlex);

					if($excluir){

						if(mysqli_num_rows($resul_1)){

							$sqlex='delete from partidas where id_partida='.$con1['id_partida'].';';

						}else if(mysqli_num_rows($resul_2)){

							$sqlex='delete from partidas where id_partida='.$con2['id_partida'].';';

						}

						$excluir=mysqli_query($conexao, $sqlex);

						if($excluir){
							?>
							
							<script> 
								window.location="pagina_time.php?info=true&id_time=<?php echo($con['id_time'])?>"
							</script>

							<?php
						}
					}
				}
			

				if(isset($_POST['cancelar'])){
					$sqlbu_noti='select * from notifica where notifi="'.$_SESSION['nome'].' deseja entrar no seu time" and id_para='.$con['id_dono'].';';

					$resul_noti=mysqli_query($conexao, $sqlbu_noti);

					$con_noti=mysqli_fetch_array($resul_noti);

					$sqlex= 'delete from notifica where id_notifica ='.$con_noti['id_notifica'].';';

					$excluir=mysqli_query($conexao, $sqlex);

					if($excluir){
						$sqlex= 'delete from chat where mensagem = "Oi, eu sou '.$_SESSION['nome'].' e tenho interresse no seu time! Pode olhar o meu perfil para saber mais sobre mim" and registro_conversa="'.$_SESSION['id_usuario'].'-'.$con['id_dono'].'";';

						$excluir=mysqli_query($conexao, $sqlex);

						if($excluir){
							$sqlex= 'delete from chat where mensagem = "Clique aqui para ver a proposta de contrato" and registro_conversa="'.$_SESSION['id_usuario'].'-'.$con['id_dono'].'";';

							$excluir=mysqli_query($conexao, $sqlex);

							if($excluir){
								$sqlex= 'delete from contrato where id_jogador='.$_SESSION['id_usuario'].' and id_contratante='.$con['id_dono'].';';

								$excluir=mysqli_query($conexao, $sqlex);

								if($excluir){
									?>
									<script> 
										window.location="pagina_time.php?info=true&id_time=<?php echo($con['id_time'])?>"
									</script>
									<?php
								}
							}
						}
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
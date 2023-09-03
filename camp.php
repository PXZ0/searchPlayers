<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
	$pagina=2;
	include('formatar_data.php');
?>

<script type="text/javascript">
	function limpa_cep(){
		document.getElementById('cidade').value=("");
		document.getElementById('uf').value=("");
	}

	function meucallback(conteudo){
		if (!("erro" in conteudo)){
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
		<link rel="stylesheet" href="./css/style_meutime.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style_camp.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
		<link rel="sortcut icon" href="./img/icon.png" type="image/x-icon" />

		<!-- Metas -->
		<meta charset="UTF-8">
		<meta name="author" content="Equipe Search Players">
		<meta name="description" content="Campeonatos da Search Players">
		<meta name="keywords" content="Search Players">
		
		<title>Search Players</title>
	</head>
	
	<body>
		<?php
			include('header.php');
		?>
		<main>
			<section style="width:400px; margin-bottom:20px;" class="mx-auto">

				<form class="form-inline my-2 my-lg-0" name="search_camp" method="POST" action="#">

					<nav class="">

		      			<?php
		      				$esporte_usuario='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
		      				$consulta_usuario=mysqli_query($conexao, $esporte_usuario);
		      				$con_usuario=mysqli_fetch_array($consulta_usuario);
		      				if(mysqli_num_rows($consulta_usuario)){
		      					if(!empty($con_usuario['esporte'])){
		      			?>
			      			<button type="button" class="btn btn-my-2 my-sm-0" style="background-color: #ff3c00;color: #fff;" data-toggle="modal" data-target="#criar_camp">
		 						+	
							</button>
						<?php
								}
							}
						?>

		     			<input class="form-control mr-sm-2" type="search" placeholder="Procurar campeonato" aria-label="Search" required>

		      			<button class="btn btn-my-2 my-sm-0" style="color: #fff; background-color: #ff3c00" type="submit">
		      				<i class="fas fa-search"></i>
		      			</button>

					</nav>

	      		</form>	

			</section>
			
			<?php
				$sqlbu='select * from campeonatos;';

				$resul=mysqli_query($conexao, $sqlbu);

				if(mysqli_num_rows($resul)){
											
					while($con=mysqli_fetch_array($resul)){	

						?>
						<div class="card mb-3 mx-auto" style="max-width: 540px; background-color: #222;">
							<a class="link_busca" href="pagina_camp.php?info=true&id_camp=<?php echo($con['id_campeonato'])?>">
				  				<div class="row no-gutters">
				    				<div class="col-md-4">
				     					<?php
				     						$foto=1;
				     						include('foto_camp.php');
				     					?>
				    				</div>
				  					<div class="col-md-8">
				     					 <div class="card-body">
				      					 	<h4 class="card-title" style="color:#ff3c00;"><?php echo($con['nome']); ?></h4>
				        					<p class="card-text">
					    						<?php
					    						$sexo='select * from usuario where id_usuario="'.$con['id_org'].'";';
					    						$consulta=mysqli_query($conexao, $sexo);
					    						$pesquisa=mysqli_fetch_array($consulta);
					    						if(mysqli_num_rows($consulta)){
					    							switch($pesquisa['sexo']){
					    								case 1:
					    						?>
					    									Organizador: <?php echo($con['nome_org']); ?>
					    						<?php
					    								break;
					    								case 2:
					    						?>
					    									Organizadora: <?php echo($con['nome_org']); ?>
					    						<?php
					    								break;
					    								default:
					    						?>
					    									Organizadorx: <?php echo($con['nome_org']); ?>
					    						<?php
					    								break;
					    							}
					    						}
					    						?>
				        					</p>
				        					<p class="card-text">Data de Inicio: <?php echo formatarData($con['d_inicio']); ?></p>
				        					<p class="card-text">Data de Termino: <?php echo formatarData($con['d_termino']); ?></p>
				        					<p class="card-text">Quantidade de Times: <?php echo($con['n_times']); ?></p>
				        					<p class="card-text">Premiação: <?php echo($con['premiacao']); ?></p>

				        					<p class="card-text">

				        						Região: 

				        						<?php echo($con['estado'].'-'.$con['cidade']); ?>	
				        					</p>

				        					<p class="card-text">

				        						Taxa de Inscrição: 

				        						<?php if(empty($con['taxa_inscricao'])){

				        							echo($con['taxa_inscricao']);

				        						}else{

				        							echo('Sem taxa');
				        						} 
				        						?>	
				        					</p>

				        					<p class="card-text">

				        						Esporte do Campeonato:

				        						<?php				        					

				        							switch ($con['esporte']) {
					        							case 1:
					        								echo('Futebol');
				        								break;

				        								case 2:
					        								echo('Basquete');
				        								break;
				        							
				        								case 3:
					        								echo('Vôlei');
				        								break;
				        							}
				        						?>
				        					</p>

				        					<p class="card-text">

				        						Tipo do Campeonato

				        						<?php
				        							switch ($con['tipo']) {
					        							case 1:
					        								echo('Fechado para times exclusivos');
				        								break;

				        								case 2:
					        								echo('Entrada somente com permissão');
				        								break;
				        							
				        								case 3:
					        								echo('Aberto a todos');
				        								break;
				        							}				        							
				        						?>
				        					</p>
				      					</div>
				    				</div>
				  				</div>
				  			</a>
						</div>
						<?php
					}
				}else{
					?>
					<section class="d-flex align-items-center flex-column erro_camp">
						<figure class="mx-auto" style="width: 400px;">
							<img class="ausencia_img" style="width: 400px;" src="./img/ausencia_dados">
						</figure>
						<p class="text-center mensagem">
							Ops... Não há Campeonatos nessa Região!
						</p>
					</section>
					<?php
				}
			?>

			<!-- Modal -->
			<form name="campeonato" method="POST" action="#" id="regi_camp">
				<div class="modal fade" id="criar_camp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  				<div class="modal-dialog">
	    				<div class="modal-content">

	     					<div class="modal-header">
	        					<h5 class="modal-title" id="exampleModalLabel">Registrar Campeonato</h5>
	       						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          						<span aria-hidden="true">&times;</span>
	        					</button>
	     					</div>

	      					<div class="modal-body">

      							<div class="form-group">
      								<label for="nome">Nome do Campeonato</label>
      								<input class="form-control" type="text" name="nome_camp" id="nome">
									<span class='erro-validacao template msg-nome'></span>
      							</div>

      							<div class="form-group">
      								<label for="data_i">Data de Inicio</label>
      								<input class="form-control" type="date" name="data_i" id="data_i">
      							</div>

      							<div class="form-group">
      								<label for="data_t">Data de Termino</label>
      								<input class="form-control" type="date" name="data_t" id="data_t">
      							</div>

      							<div class="form-group">
      								<label for="quantidade">Quantidade de Times</label>
      								<input class="form-control" type="number" name="quantidade" id="quantidade">
									<span class='erro-validacao template msg-ntime'></span>
      							</div>

      							<div class="form-group">
      								<label for="premio">Premiação</label>
      								<input class="form-control" type="text" name="premio" id="premio">
									<span class='erro-validacao template msg-premio'></span>
      							</div>

      							<div class="form-group">
      								<label for="taxa">Taxa de Inscrição</label>
      								<input class="form-control" type="text" name="taxa" id="taxa">
									<span class='erro-validacao template msg-taxa'></span>
      							</div>

								<section>	
									<label for="cep">
										CEP
									</label>
									<input class="form-control" name="cep" type="text" id="cep" size=10 placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);">
									<span class='erro-validacao template msg-cep'></span>
								</section>

								<section>	
									<label for="uf">
										Estado
									</label>
									<select class="form-control" id="uf" name="uf">
										<option value="AC" >Acre</option>
										<option value="AL">Alagoas</option>
										<option value="AP">Amapá</option>
										<option value="AM">Amazonas</option>
										<option value="BA">Bahia</option>
										<option value="CE">Ceará</option>
										<option value="DF">Distrito Federal</option>
										<option value="ES">Espírito Santo</option>
										<option value="GO">Goiás</option>
										<option value="MA">Maranhão</option>
										<option value="MT">Mato Grosso</option>
										<option value="MS">Mato Grosso do Sul</option>
										<option value="MG">Minas Gerais</option>
										<option value="PA">Pará</option>
										<option value="PB">Paraíba</option>
										<option value="PR">Paraná</option>
										<option value="PE">Pernambuco</option>
										<option value="PI">Piauí</option>
										<option value="RJ">Rio de Janeiro</option>
										<option value="RN">Rio Grande do Norte</option>
										<option value="RS">Rio Grande do Sul</option>
										<option value="RO">Rondônia</option>
										<option value="RR">Roraima</option>
										<option value="SC">Santa Catarina</option>
										<option value="SP">São Paulo</option>
										<option value="SE">Sergipe</option>
										<option value="TO">Tocantins</option>
									</select>
									<span class='erro-validacao template msg-uf'></span>
								</section>
							
								<section>
									<label for="cidade">
										Cidade
									</label>
									<input class="form-control" name="cidade" type="text" id="cidade" placeholder="Cidade" size="40">
									<span class='erro-validacao template msg-cidade'></span>
								</section>

								<legend>
									Tipo de Campeonato
								</legend>

								<input type="radio" name="tipo" value='1' id="1" required="required"/>
								<label for="1">
									Fechado para times exclusivos
								</label>

								<input type="radio" name="tipo" value='2' id="2">
								<label for="2">
									Somente com permissão
								</label>

								<input type="radio" name="tipo" value='3' id="3">								
								<label for="3">
									Aberto a todos
								</label>

							</div>

	      					<div class="modal-footer">

	    						<button type="button" class="btn btn-secondary" data-dismiss="modal">
	    							Cancelar
	    						</button>

	    						<input name="criar" value="Criar" type="submit" class="btn btn-primary"/>

	     					</div>
	    				</div>
	  				</div>
				</div>
			</form>

			<?php
				if(isset($_POST['criar'])){
					$nome=$_POST['nome_camp'];
					$n_times=$_POST['quantidade'];
					$d_inicio=$_POST['data_i'];
					$d_termino=$_POST['data_t'];
					$taxa=$_POST['taxa'];
					$cep=$_POST['cep'];
					$cidade=$_POST['cidade'];
					$estado=$_POST['uf'];
					$premiacao=$_POST['premio'];
					$consulta_esporte='select * from usuario where id_usuario="'.$_SESSION['id_usuario'].'";';
					$pesquisa_esporte=mysqli_query($conexao, $consulta_esporte);
					$tipo_esporte=mysqli_fetch_array($pesquisa_esporte);
					if(mysqli_num_rows($pesquisa_esporte)){
						$esporte=$tipo_esporte['esporte'];
					}
					$tipo=$_POST['tipo'];

					$sqlin='insert into campeonatos (nome, id_org, nome_org, n_times, d_inicio, d_termino, taxa_inscricao, cep, estado, cidade, premiacao, esporte, tipo) values("'.$nome.'", '.$_SESSION['id_usuario'].', "'.$_SESSION['nome'].'", '.$n_times.', "'.$d_inicio.'", "'.$d_termino.'", '.$taxa.', "'.$cep.'", "'.$estado.'", "'.$cidade.'", "'.$premiacao.'", '.$esporte.', '.$tipo.');';

					$inserir=mysqli_query($conexao, $sqlin);

					if($inserir){

						$sqlbu='select * from campeonatos where nome="'.$nome.'" and d_inicio="'.$d_inicio.'" and d_termino="'.$d_termino.'";';

						$resul=mysqli_query($conexao, $sqlbu);

						if($resul){

							$con_camp=mysqli_fetch_array($resul);

							?>
							<section>
								<div class="modal fade" id="camp_criado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								    <div class="modal-dialog">
								    	<div class="modal-content">
								      		<div class="modal-header">
								        		<h5 class="modal-title" id="exampleModalLabel">Parabéns! você acabou de criar um campeonato</h5>
								     		</div>
								     		<div class="modal-body">
								     			Será iniciado o processo para que os times façam a entrada nele, caso nenhum time entre o campeonato será cancelado.
								     		</div>				     
							     			<div class="modal-footer">
							     				<?php echo('<a href="pagina_camp.php?info=true&id_camp='.$con_camp['id_campeonato'].'"'); ?>>
										        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completa">OK</button>
										        </a>
										    </div>
										</div>
									</div>
								</div>
							</section>							

							<script type="text/javascript">
								$(document).ready(function(){
									$('#camp_criado').modal('show');
								});
							</script>

							<?php
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
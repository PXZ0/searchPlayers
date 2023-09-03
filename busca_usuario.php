<?php

	$sqlbu_usuario='select * from usuario where nome like "%'.$busca.'%";';

	$resul_usuario=mysqli_query($conexao, $sqlbu_usuario);

	$linhas_usuario=mysqli_num_rows($resul_usuario);

	if($linhas_usuario==0){

		if($aparecer==0){

			$pesquisa_filtro=1;

			include('sem_resultados.php');

			$aparecer=1;
		}

	}else{

		while($con=mysqli_fetch_array($resul_usuario)){								
			if($con['id_usuario']!=$_SESSION['id_usuario']){

				?>
					<div class="card mx-auto mt-3" style="max-width: 540px; background-color: #222222;">
						<a class="link_busca" href="pagina_usuario.php?info=true&id_usuario=<?php echo($con['id_usuario'])?>">
							<div class="row no-gutters">
								<div class="col-md-4 ">
								    <figure class="d-flex align-content-center mx-auto" style="width: 150px;">
										<?php	 
											$foto=1;						
											include('foto_usuario.php');
										?>
									</figure>
								</div>
							    <div class="col-md-8">
							    	<div class="card-body">
							    		<h5 class="card-title titulo">
											<?php
												echo(ucwords($con['nome']));
											?>
										</h5>
										<p class="card-text text_mensagem">
											<?php
													switch ($con['sexo']){
														case '1':
															echo('Tipo de Usuário:');
														break;

														case '2':
															echo('Tipo de Usuária:');
														break;

														default:
															echo('Tipo de Usuárix:');
														break;
													}
												?>
											<?php
												if($con['sexo']=='1'){
													switch ($con['tipo_usuario']){
														case 1:
															echo('Jogador');
														break;

														case 2:
															echo('Contratante');
														break;

														case 3:
															echo('Analisador');
														break;

														default:
															echo('Esse tipo de usuario não existe');
														break;
													}
												}
												else if($con['sexo']=='2'){
													switch ($con['tipo_usuario']){
														case 1:
															echo('Jogadora');
														break;

														case 2:
															echo('Contratante');
														break;

														case 3:
															echo('Analisadora');
														break;

														default:
															echo('Esse tipo de usuario não existe');
														break;
													}
												}
												else{
													switch ($con['tipo_usuario']){
														case 1:
															echo('Jogadorx');
														break;

														case 2:
															echo('Contratante');
														break;

														case 3:
															echo('Analisadorx'); 
														break;

														default:
															echo('Esse tipo de usuario não existe');
														break;
													}
												}
											?>
										</p>
										<p class="card-text text_mensagem">
											Localização:
											<?php
												if(isset($con['cidade_usu'])){
													echo ($con['cidade_usu'].' - '.$con['estado_usu']);
												}else{
													echo("Desconhecida");
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
			}
		}					
?>
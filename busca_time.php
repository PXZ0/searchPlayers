<?php
	$sqlbu_time='select * from times where nome like "%'.$busca.'%";';

	$resul_time=mysqli_query($conexao, $sqlbu_time);

	$linhas_time=mysqli_num_rows($resul_time);


	if($linhas_time==0){

		if($aparecer==0){

			$pesquisa_filtro=1;

			include('sem_resultados.php');

			$aparecer=1;
		}
	}else{

		while($con=mysqli_fetch_array($resul_time)){ 
			if($con['id_dono']!=$_SESSION['id_usuario']){								
				?>
					<div class="card mx-auto mt-3" style="max-width: 540px; background-color: #222222;">
						<a class="link_busca" href="pagina_time.php?info=true&id_time=<?php echo($con['id_time'])?>">
							<div class="row no-gutters">
								<div class="col-md-4 ">
								    <figure class="d-flex align-content-center mx-auto" style="width: 150px;">
										<?php	 
											$foto=1;						
											include('foto_time.php');
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
										<p class="card-text text_mensagem">
											Localização da Sede:
											<?php
												if(isset($con['cidade_sede'])){
													echo ($con['cidade_sede'].' - '.$con['uf_sede']);
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
<?php 
	include('conexao.php');
?>
<footer>
	<section class="area_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h3 class="footer_title">Sugestões</h3>
					<form name="sugestao" method="POST" action="#">

						<div class="form-grup">
							<label for="nome" style="color:#100b25;">Nome</label>
							<input id="Nome" class="form-control" disabled type="text" name="nome_sug" value=<?php echo ('"'.(ucwords($_SESSION['nome'])).'"'); ?>>
						</div>
					
					
						<div class="form-grup">
							<label for="email" style="color:#100b25;">Email</label>
							<input class="form-control"  disabled type="text" name="email_sug" value=<?php echo($_SESSION['email']); ?>>
						</div>
						
						<div class="form-grup">	
							<label for="mensagem" style="color:#100b25;">Sugestão</label>
							<textarea class="form-control" style="resize: none;;;;;" name="sugestao" rows="4" placeholder="Digite sua Sugestão" required="required"/></textarea>
						</div>
						<button class="btn btn-outline-light btn-lg mt-3 btn-block" type="submit" name="enviar_sugestao">Enviar</button>
					</form>
				</div>
				<section>
					<div class="modal fade" id="sucesso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel">
					        			<?php
					        				switch($_SESSION['sexo']){
					        					case 1:
					        						echo('Agradecemos a sua sugestão, iremos tentar atende-lo o mais rápido possível!');
					        					break;
					        					case 2:
					        						echo('Agradecemos a sua sugestão, iremos tentar atende-la o mais rápido possível!');
					        					break;
					        					default:
					        						echo('Agradecemos a sua sugestão, iremos tentar atende-lx o mais rápido possível!');
					        					break;
					        				}
					        			?>
					        		</h5>
					     		</div>
				     			<div class="modal-footer">
							        <a href="home.php"><button type="button" class="btn btn-secondary">OK</button></a>
							    </div>
							</div>
						</div>
					</div>
				</section>
				<section>
					<div class="modal fade" id="falha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title" id="exampleModalLabel">Não foi possível enviar sua sugestão, tente novamente!</h5>
					     		</div>
				     			<div class="modal-footer">
							        <a href="home.php"><button type="button" class="btn btn-secondary">OK</button></a>
							    </div>
							</div>
						</div>
					</div>
				</section>

				<?php

					if(isset($_POST['enviar_sugestao'])){
						$nome=$_SESSION['nome'];
						$id_usuario=$_SESSION['id_usuario'];
						$email=$_SESSION['email'];
						$sugestao=$_POST['sugestao'];

						$enviar_sug='insert into sugestoes(nome, id_usuario, email, sugestao) values("'.$nome.'", "'.$id_usuario.'", "'.$email.'", "'.$sugestao.'")';

						$enviar_banc=mysqli_query($conexao, $enviar_sug);

						if($enviar_banc){
							?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#sucesso').modal('show');	
									});
								</script>
							<?php
						}else{
							?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#falha').modal('show');	
									});
								</script>
							<?php
						}

					}
					?>
				<div class="col-md-6">
					<h3 class="footer_title">Nossas Redes Sociais</h3>	
						<section class="d-flex align-items-center flex-column">
							<div class="mx-auto" style="width: 250px;">
								<img class="redes_sociais" style="width: 250px;" src="./img/redes_sociais">
							</div>
						</section>	
						<section class="text-center" style="margin-top: 25px;">
							<a href="https://www.instagram.com/search_players/" target="_blank">
								<button class="btn btn-danger" style="background-color:#ff3c00; color:#100b25;"><i class="fab fa-instagram"></i> @search_players</button>
							</a>
							<a href="https://www.facebook.com/searchplayers" target="_blank">
								<button class="btn btn-danger" style="background-color:#ff3c00; color:#100b25;"><i class="fab fa-facebook-square"></i> Search Players</button>
								
							</a>	
						</section>		
				</div>
			</div>
		</div>
	</section>
	<section class="area_copy">
		<div class="container">
			<div class="row">
				<p class="col-md-12">
					Copyright &copy; 2020 Search Players.
				</p>
			</div>
		</div>
	</section>
</footer>
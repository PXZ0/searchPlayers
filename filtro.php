<!--Modal-Filtro-->
		<section>
			<div class="modal fade" id="filtrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				 <div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="exampleModalLabel">Filtrar Usuárixs</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        			<span aria-hidden="true">&times;</span>
			        		</button>
			     		</div>
				      	<div class="modal-body">
				      		<div class="container-fluid">	
								<form name="filtrar" method="POST" action="filtrar_contatos.php">
									<div class="form-group">
										<label for="tipo_usuario">
											Tipo de Usuárix
										</label>
										<select class="custom-select" name="tipo_usuario" required="required"/>
											<option value="" ></option>
											<option value="1">Jogadorx de Aluguel</option>
											<option value="2">Administradorx de Um Time</option>
											<option value="3">Analisadorx de Partidas</option>
										</select>
									</div>
									<div class="form-group">
										<label for="esporte_usuario">
											Esporte
										</label>
										<select class="custom-select" name="esporte_usuario" required="required"/>
											<option value=""></option>
											<option value="1">Futebol</option>
											<option value="2">Basquete</option>
											<option value="3">Vôlei</option>
											<option value="NULL">Indefinido</option>
										</select>
									</div>
									<div class="form-group">
										<label for="sexo">
											Sexo
										</label>
										<select class="custom-select" name="sexo" required="required"/>
											<option value=""></option>
											<option value="1">Masculino</option>
											<option value="2">Feminino</option>
											<option value="NULL">Indefinido</option>
										</select>
									</div>
			     		<div class="modal-footer">
			     					<input type="submit" name="filtrar" value="Filtrar Usuárixs" style="background-color:#ff3c00;" class="btn btn-danger">
								</form>
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						</div>		
				    </div>
				</div>
			</div>
		</section>

<!---->
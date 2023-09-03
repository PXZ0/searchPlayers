<nav class="col-md-3 d-flex justify-content-end nav_config">
	<ul class="menu_config">
		<li class="menu_config_item">
			<h5><a href="config_perfil.php" class="text_menu_config"> Editar Perfil</a></h5>
		</li>
		<li  class="menu_config_item">
			<h5><a class="text_menu_config" href="config_conta.php">Configurações da Conta</a></h5>
		</li>
		<li  class="menu_config_item">
			<h5><a href="localiza.php" class="text_menu_config">Localização</a></h5>
		</li>
		<?php
			$sqlbu='select * from times where id_dono='.$_SESSION['id_usuario'].';';

			$resul=mysqli_query($conexao, $sqlbu);

			if(mysqli_num_rows($resul)){
				?>
				<li  class="menu_config_item">
					<h5><a href="config_time.php" class="text_menu_config">Time</a></h5>
				</li>
				<?php
			}
		?>
	</ul>
</nav>
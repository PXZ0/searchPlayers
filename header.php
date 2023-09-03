<header class="navbar navbar-expand navbar-dark flex-column fixed-top flex-md-row bd-navbar">
	<a class="navbar-brand mr-0 mr-md-2" href="home.php">
		<img class="logo" src="./img/logo_light.png" alt="Logo Search Players">
	</a>
	<section class="itens_1">
		<input type="checkbox" id="hamburguer" style="display: none;">
		<label for="hamburguer">
			<div class="hamburguer">
			</div>
		</label>
		<nav class="menu scrollbar-warning">
			<ul class="menu_list">
				<li class="menu_item_perfil border-bottom border-white">
					<a href="perfil.php">
						<figure>
							<?php
								if(empty($_SESSION['foto_usuario'])){
									if(empty($_SESSION['sexo'])||$_SESSION['sexo']==1){
										echo('<img class="user_img" src="./img/foto_perfis/user_m.svg" alt="Imagem do Usuário">');
									}else{
										echo('<img class="user_img" src="./img/foto_perfis/user_f.svg" alt="Imagem do Usuário">');
									}
								}else{
									echo('<img class="user_img rounded-circle" src="./img/foto_perfis/'.$_SESSION['foto_usuario'].'" alt="Imagem do usuário">');
								}
							?>
						</figure>
					</a>

					<a class="menu_link_perfil" href="perfil.php">
						<h4>
							<?php echo(ucwords($_SESSION['nome']));?>
						</h4>
					</a>
				</li>
				<li class="menu_item">							
					<a class="menu_link" href="home.php">
						<i class="menu_icon fas fa-home"></i>
						Home
					</a>
				</li>
				<?php
					$classe=$_SESSION['tipo_usuario'];

					switch ($classe) {
						case 1:
							?>
							<li class="menu_item">
								<a class="menu_link" href="meus_times.php">
									<i class="menu_icon fas fa-users"></i>
									Meus times
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="times.php">
									<i class="menu_icon fas fa-users"></i>
									Times
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="partidas.php">
									<i class="menu_icon fas fa-futbol"></i>
									Partidas
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="camp.php">
									<i class="menu_icon fas fa-trophy"></i>
									Campeonatos
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="rank_jogadores.php">
									<i class="menu_icon fas fa-award"></i>
									Ranking
								</a>
							</li>	
							<?php
						break;

						case 2:
							?>									
							<li class="menu_item">
								<a class="menu_link" href="meu_time.php">
									<i class="menu_icon fas fa-users"></i>
									Meu time
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="times.php">
									<i class="menu_icon fas fa-users"></i>
									Times
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="jogadores.php">
									<i class="menu_icon fas fa-user"></i>
									Jogadores
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="partidas.php">
									<i class="menu_icon fas fa-futbol"></i>
									Partidas
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="camp.php">
									<i class="menu_icon fas fa-trophy"></i>
									Campeonatos
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="rank_times.php">
									<i class="menu_icon fas fa-award"></i>
									Ranking
								</a>
							</li>
							<?php
						break;

						case 3:
							?>
							<li class="menu_item">
								<a class="menu_link" href="partidas.php">
									<i class="menu_icon fas fa-futbol"></i>
									Partidas
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="camp.php">
									<i class="menu_icon fas fa-trophy"></i>
									Campeonatos
								</a>
							</li>

							<li class="menu_item">
								<a class="menu_link" href="rank_times.php">
									<i class="menu_icon fas fa-award"></i>
									Ranking
								</a>
							</li>
							<?php								
						break;					 			
							
						default:
							?>
							<p>
								Tipo de Usuario não encontrado
							</p>
							<?php
						break;
					}
				?>
			</ul>
		</nav> 

		<form class="search_box" name="pesquisar" method="POST" action="buscar.php">
			<input class="search_txt" type="text" name="busca" placeholder="Pesquisar" required="required"/ value=<?php if(!empty($_POST['busca'])){ echo('"'.$_POST['busca'].'"'); } ?> >
			<button class="search_btn" type="submit" name="enviar">
				<i class="fas fa-search"></i>
			</button>
		</form>
	</section>
	<ul class="navbar-nav ml-md-auto">
		<li class="nav-item">
			<a class="nav-link pl-2 pr-1 mx-1 py-3 my-n2" href="contatos_chat.php">
				<i class="far fa-comment"></i>
			</a>
		</li>

		<script type="text/javascript">
			function ajax_notifica(){
				var req = new XMLHttpRequest();
				req.onreadystatechange=function(){
					if(req.readyState==4 && req.status==200){
						document.getElementById('notificacoes').innerHTML=req.responseText;
					}
				}
				req.open('GET', 'functions_notifica.php', true);
				req.send();
			}

			setInterval(function(){ajax_notifica();}, 1000);
		</script>

		<li class="nav-item dropdown">
			<a class="nav-link dropdown px-1 mx-1 py-3 my-n2" id="bell" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="far fa-bell"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="bell">
				<div id="notificacoes">
				</div>
			</div>
		</li>	

		<li class="nav-item dropdown">
			<a class="nav-link dropdown px-1 mx-1 py-3 my-n2" id="config" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-angle-down"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="config">
				<a class="dropdown-item" href="config_perfil.php">Configurações</a>
				<a class="dropdown-item" href="perfil.php">Perfil</a>
				<a class="dropdown-item" href="deslogar.php">Sair</a>
			</div>
		</li>
	</ul>
</header>	  	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" ></script>
<script type="text/javascript" src="./js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" integrity="sha384-9/D4ECZvKMVEJ9Bhr3ZnUAF+Ahlagp1cyPC7h5yDlZdXs4DQ/vRftzfd+2uFUuqS" crossorigin="anonymous"></script>
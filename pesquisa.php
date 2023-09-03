<section class="busca_chat">
	<nav class="">
		<form class="form-inline my-2 my-lg-0 mx-auto" style="width: 300px;" name="search_camp" method="POST" action="pesquisar_contatos.php">
			<a href="#" data-toggle="modal" data-target="#filtrar" class="form-control mr-sm-2 btn btn-danger" style="color: #fff; background-color: #ff3c00"><i class="fas fa-angle-down"></i></a>
	  		<input class="form-control mr-sm-2" type="search" name="caracter" placeholder="Digite umx Usuárix..." aria-label="Search" required="required"/ value=<?php if(!empty($_POST['caracter'])){ echo('"'.$_POST['caracter'].'"'); } ?>>
	      	<button name="pesquisar" class="btn btn-my-2 my-sm-0" style="color: #fff; background-color: #ff3c00" type="submit"><i class="fas fa-search"></i></button>
	    </form>
	</nav>
</section>
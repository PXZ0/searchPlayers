<?php
	if(empty($_SESSION['banner_usuario'])){
		echo('<img class="banner d-block" src="./img/banners_perfis/banner_usuario.jpeg" alt="Banner do Usuário">');
	}else{
		echo('<img class="banner d-block" src="./img/banners_perfis/'.$_SESSION['banner_usuario'].'" alt="Banner do Usuário">');
	}
?>
<?php
	switch ($foto) {
	 	case 1:
	 		if(empty($con['foto_usuario'])){
				if(empty($con['sexo'])||$con['sexo']==1||$con['sexo']==NULL){
					echo('<img class="foto_chat" src="./img/foto_perfis/user_m.svg" alt="Imagem do Usuário">');
				}else{
					echo('<img class="foto_chat" src="./img/foto_perfis/user_f.svg" alt="Imagem do Usuário">');
				}
			}else{
				echo('<img class="foto_chat rounded-circle" src="./img/foto_perfis/'.$con['foto_usuario'].'" alt="Imagem do usuário">');
			} 
	 	break;

	 	case 2:
	 		if(empty($_SESSION['foto_usuario'])){
				if(empty($_SESSION['sexo'])||$_SESSION['sexo']==1||$con['sexo']==NULL){
					echo('<img class="foto_chat" src="./img/foto_perfis/user_m.svg" alt="Imagem do Usuário">');
				}else{
					echo('<img class="foto_chat" src="./img/foto_perfis/user_f.svg" alt="Imagem do Usuário">');
				}
			}else{
				echo('<img class="foto_chat rounded-circle" src="./img/foto_perfis/'.$_SESSION['foto_usuario'].'" alt="Imagem do usuário">');
			}
		break;
	}		
?>
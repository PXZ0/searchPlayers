<?php
switch ($foto) {
	case 1:
		if(empty($con['foto_time'])){
			echo('<img class="foto_chat" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_chat rounded-circle" src="./img/foto_time/'.$con['foto_time'].'" alt="Imagem do usuário">');
		}
	break;

	case 2:
		if(empty($con['foto_time'])){
			echo('<img class="foto_chat" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_chat" rounded-circle" src="./img/foto_time/'.$con_time1['foto_time'].'" alt="Imagem do usuário">');
		}
	break;

	case 3:
		if(empty($con['foto_time'])){
			echo('<img class="foto_chat" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class"foto_chat" foto_media rounded-circle" src="./img/foto_time/'.$con_time2['foto_time'].'" alt="Imagem do usuário">');
		}
	break;
}
?>
<?php
switch ($foto) {
	case 1:
		if(empty($con['foto_time'])){
			echo('<img class="foto_media" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_media rounded-circle" src="./img/foto_time/'.$con['foto_time'].'" alt="Imagem do usuário">');
		}
	break;

	case 2:
		if(empty($con_time1['foto_time'])){
			echo('<img class="foto_media" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_media rounded-circle" src="./img/foto_time/'.$con_time1['foto_time'].'" alt="Imagem do usuário">');
		}
	break;

	case 3:
		if(empty($con_time2['foto_time'])){
			echo('<img class="foto_media" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_media rounded-circle" src="./img/foto_time/'.$con_time2['foto_time'].'" alt="Imagem do usuário">');
		}
	break;

	case 4:
		?>
		<a href="pagina_time.php?info=true&id_time=<?php echo($con_time2['id_time'])?>">
			<?php
				if(empty($con_time2['foto_time'])){

					echo('<img class="foto_partidas d-flex justify-content-center flex-column" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
					echo('<p class="text-center">'.$con_time2['nome'].'</p>');
				}else{
					echo('<img class="foto_partidas d-flex justify-content-center flex-column rounded-circle" src="./img/foto_time/'.$con_time2['foto_time'].'" alt="Imagem do usuário">');
					echo('<p class="text-center">'.$con_time2['nome'].'</p>');
				}
			?>
		</a>
		<?php
	break;

	case 5:
	?>
		<a href="pagina_time.php?info=true&id_time=<?php echo($con_time1['id_time'])?>">
	<?php
		if(empty($con_time1['foto_time'])){
			echo('<img class="foto_partidas d-flex justify-content-center flex-column" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
			echo('<p class="text-center">'.$con_time1['nome'].'</p>');
		}else{
			echo('<img class="foto_partidas d-flex justify-content-center flex-column rounded-circle" src="./img/foto_time/'.$con_time1['foto_time'].'" alt="Imagem do usuário">');
			echo('<p class="text-center">'.$con_time1['nome'].'</p>');
		}
	?>
		</a>
	<?php
	break;

	case 6:
		if(empty($con_time2['foto_time'])){

			echo('<img class="foto_partidas d-flex justify-content-center flex-column" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
			echo('<p class="text-center">'.$con_time2['nome'].'</p>');
		}else{
			echo('<img class="foto_partidas d-flex justify-content-center flex-column rounded-circle" src="./img/foto_time/'.$con_time2['foto_time'].'" alt="Imagem do usuário">');
			echo('<p class="text-center">'.$con_time2['nome'].'</p>');
		}
	break;

	case 7:
		if(empty($con_time1['foto_time'])){
			echo('<img class="foto_partidas d-flex justify-content-center flex-column" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
			echo('<p class="text-center">'.$con_time1['nome'].'</p>');
		}else{
			echo('<img class="foto_partidas d-flex justify-content-center flex-column rounded-circle" src="./img/foto_time/'.$con_time1['foto_time'].'" alt="Imagem do usuário">');
			echo('<p class="text-center">'.$con_time1['nome'].'</p>');
		}
	break;

	case 8:
		if(empty($con_time['foto_time'])){
			echo('<img class="foto_chat" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_chat rounded-circle" src="./img/foto_time/'.$con_time['foto_time'].'" alt="Imagem do usuário">');
		}
	break;

	case 9:
		if(empty($con_time['foto_time'])){
			echo('<img class="foto_media" src="./img/foto_time/brasao.svg" alt="Imagem do Usuário">');
		}else{
			echo('<img class="foto_media rounded-circle" src="./img/foto_time/'.$con_time['foto_time'].'" alt="Imagem do usuário">');
		}
	break;
}
?>
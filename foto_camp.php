<figure>
	<?php

	switch ($foto) {
		case 1:
			if(empty($con['foto'])){
				echo('<img class="card-img" src="./img/foto_camps/padrao.png" alt="Arte do Campeonato">');
			}else{
				echo('<img class="card-img" src="./img/foto_camps/'.$con['foto_camp'].'" alt="Arte do Campeonato">');
			}
		break;

		case 2:
			if(empty($con_camp['foto'])){
				echo('<img class="card-img" src="./img/foto_camps/padrao.png" alt="Arte do Campeonato">');
			}else{
				echo('<img class="card-img" src="./img/foto_camps/'.$con_camp['foto'].'" alt="Arte do Campeonato">');
			}
		break;
		case 3:
			if(empty($con_camp['foto'])){
				echo('<img class="img_camp" src="./img/foto_camps/padrao.png" alt="Arte do Campeonato">');
			}else{
				echo('<img class="img_camp" src="./img/foto_camps/'.$con_camp['foto'].'" alt="Arte do Campeonato">');
			}
		break;

	}
	?>
</figure>
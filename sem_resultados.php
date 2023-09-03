<?php
	switch ($pesquisa_filtro) {
		case 1:
			?>
				<section class="d-flex align-items-center flex-column">
					<div class="mx-auto" style="width: 400px;">
						<img class="sem_pesquisa" style="width: 400px;" src="./img/sem_pesquisa">
					</div>
					<p class="text-center text_mensagem">
						Nenhum resultado achado para essa pesquisa!
					</p>
				</section>	
			<?php
		break;
		
		case 2:
			?>
				<section class="d-flex align-items-center flex-column">
					<div class="mx-auto" style="width: 400px;">
						<img class="sem_pesquisa" style="width: 400px;" src="./img/sem_pesquisa">
					</div>
					<p class="text-center text_mensagem">
						Nenhum resultado achado com esses parâmetros de filtro!
					</p>
				</section>
			<?php
		break;

		case 3:
			?>
				<section class="d-flex align-items-center flex-column">
					<div class="mx-auto" style="width: 400px;">
						<img class="sem_pesquisa" style="width: 400px;" src="./img/sem_pesquisa">
					</div>
					<p class="text-center text_mensagem">
						Nenhum jogador encontrado!
					</p>
				</section>
			<?php
		break;
	}
?>
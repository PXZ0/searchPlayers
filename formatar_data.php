<?php
	switch($pagina){
		case 1:
			function formatarData($data){
				setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR.UTF-8', 'pt_BR.UTF-8', 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');
				echo strftime('%H:%M', strtotime($data));
			}
		break;
		case 2:
			function formatarData($data){
				setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');
				echo strftime('%d de %B de %Y', strtotime($data));
			}
			function formatarHora($hora){
				setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR.UTF-8', 'pt_BR.UTF-8', 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');
				echo strftime('%H:%M', strtotime($hora));
			}
		break;
	}
?>
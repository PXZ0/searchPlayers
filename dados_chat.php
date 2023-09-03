<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
<?php
	include('conexao.php');
	session_start();
	include('verifica_login.php');
	$pagina=1;
	include('formatar_data.php');
	$mensagens='SELECT * FROM chat WHERE registro_conversa="'.$_SESSION['registro_conversa1'].'" or registro_conversa="'.$_SESSION['registro_conversa2'].'" ORDER by id_mensagem ';
	$executar=mysqli_query($conexao, $mensagens);
	$consulta=mysqli_num_rows($executar);
	if($consulta==0){
		$tipo_chat=1;
		include('sem_mensagem.php');
	}else{
		while($linha=mysqli_fetch_array($executar)){
?>

		<section id="dados-chat">
			<?php
				$hiperlink=ltrim($linha['mensagem'], "https://");
				$hiperlink2=('https://'.$hiperlink);
				if($linha['registro_conversa']==$_SESSION['registro_conversa1']){
			?>
			<div class="container_chat usuario">
				<div class="box_chat">
					<span class="mensagem text-break"><?php if($hiperlink2==$linha['mensagem']){ ?><a target="_blank" href=<?php echo($linha['mensagem']); ?>><?php echo($linha['mensagem']); ?></a><?php }else{ echo($linha['mensagem']); } ?></span>
					<div class="container_hora">
						<span ><a href="apagar_mensagem.php?id_mensagem=<?php echo($linha['id_mensagem']); ?>"> &times;</a></span>
						<time class="hora">
							<?php echo formatarData($linha['data']); ?>
						</time>
					</div>
				</div>
			</div>
			<?php
				}
				else if($linha['registro_conversa']==$_SESSION['registro_conversa2']){
			?>
			<div class="container_chat estrangeiro">
				<div class="box_chat">
					<?php
						if(!empty($linha['link'])){
							echo('<a href="'.$linha['link'].'">');
						}
						?>

						<span class="mensagem text-break"><?php if($hiperlink2==$linha['mensagem']){ ?><a target="_blank" href=<?php echo($linha['mensagem']); ?>><?php echo($linha['mensagem']); ?></a><?php }else{ echo($linha['mensagem']); } ?></span>
						
						<?php
						if(!empty($linha['link'])){
							echo('</a>');
						}
					?>
					<div class="container_hora">
						<time class="hora">
							<?php echo formatarData($linha['data']); ?>
						</time>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</section>
	<?php 
		}
	} 

	?>
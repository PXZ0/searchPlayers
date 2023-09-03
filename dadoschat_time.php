<?php
	include('conexao.php');
	session_start(); 
	include('verifica_login.php');
	$pagina=1;
	include('formatar_data.php');

	$mensagens='SELECT * FROM chat_time WHERE id_time="'.$_SESSION['id_time'].'" order by id_time';

	$executar=mysqli_query($conexao, $mensagens);

	$consulta=mysqli_num_rows($executar);

	if($consulta==0){
		$tipo_chat=2;
		include('sem_mensagem.php');
	}else{

		while($con=mysqli_fetch_array($executar)){
			?>

			<div id="dados-chat">

				<?php
					$hiperlink=ltrim($con['mensagem'], "https://");
					$hiperlink2=('https://'.$hiperlink);
					if($con['id_usuario']==$_SESSION['id_usuario']){
				?>
				<div class="container_chat usuario">
					<div class="box_chat">
						<span><p class="nome" >Você </p></span>
						<span class="mensagem text-break"><?php if($hiperlink2==$con['mensagem']){ ?><a target="_blank" href=<?php echo($con['mensagem']); ?>><?php echo($con['mensagem']); ?></a><?php }else{ echo($con['mensagem']); } ?></span>
						<div class="container_hora">
								<span ><a href="apagarmensagem_time.php?id_mensagem=<?php echo($con['id_mensagem']); ?>"> &times;</a></span>
								<time class="hora">
									<?php echo formatarData($con['data']); ?>
								</time>
							</div> 
					</div>
				</div>
				<?php
					}else{
				?>
				<div class="container_chat estrangeiro">
					<div class="box_chat">
						<span><p class="nome" ><?php echo($con['nome']);?></p></span>
						<span class="mensagem text-break"><?php if($hiperlink2==$con['mensagem']){ ?><a target="_blank" href=<?php echo($con['mensagem']); ?>><?php echo($con['mensagem']); ?></a><?php }else{ echo($con['mensagem']); } ?></span>
						<div class="container_hora">
							<time class="hora">
								<?php echo formatarData($con['data']); ?>
							</time>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
			<?php 
		}
	} 
	?>			
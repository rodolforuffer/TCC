<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es-CL">
  <head>
    <?php 
    	require_once("head.php");
    ?>
  </head>
  <body>
  	<div class="navbar navbar navbar-inverse navbar-fixed-top">
	  <?php 
	  	require_once("nav.php");
	  ?>
	</div>
	<div class="container">
        <?php
			error_reporting(0);
			$mensaje = $_GET["msg"];
			if ($mensaje == 1) {
                echo "<script>alert('Dados gravados com sucesso!');</script>";
			}
			if ($mensaje == 2) {
                echo "<script>alert('Dados modificados com sucesso!');</script>";
			}
			if ($mensaje == 3) {
                echo "<script>alert('Dados deletados com sucesso!');</script>";
			}
            if ($mensaje == 4) {
                echo "<script>alert('Logout efetuado com sucesso!');</script>";
			}
            if ($mensaje == 5) {
                echo "<script>alert('Você já está participando do projeto!');</script>";
			}
		?>  
        <?php if($_SESSION['logout'] == null){ ?>
		<h2>Me ajude a montar uma base de dados!</h2>
        <p class="text-info">O objetivo deste projeto é montar uma base de dados para o meu projeto final sobre data mining (mineração de dados).</p>
        <p class="text-info">Basta clicar no botão azul abaixo, aceitar as permissões no <b>facebook</b> e digitar seu <b>cep</b> que o cadastro ocorrerá de forma rápida.</p>
        <p class="text-info">Qualquer dúvida ou curiosidade sobre este projeto entre em contato por <a href="contatos.php"><u><b><i>email</i></b></u></a> ou pelas <a href="contatos.php"><u><b><i>redes sociais.</i></b></u></a></p><br/>
      <div>
          <?php 
    	require_once("face_login.php");
           ?>
      </div>       
        
        <h3>Acesse pelo celular através do QR Code</h3>
        <img src="fotos/static_qr_code_without_logo.jpg"/>
        
        <?php }else{ ?>
        <img src="fotos/thank-you-desktopnexus.jpg"/>
        <h2><center>Obrigado por me ajudar <?php echo $_SESSION['nome']?>, agora somos <?php require_once("conect_mongo.php"); echo '<font color="red">'.$c_usuarios->count().'</font>'; ?>!</center></h2>
        <p class="text-info">Qualquer dúvida ou curiosidade sobre este projeto entre em contato por <a href="contatos.php"><u><b><i>email</i></b></u></a> ou pelas <a href="contatos.php"><u><b><i>redes sociais.</i></b></u></a></p>
		<h3>Lista de usuários que estão participando do projeto:</h3>
		<table class="table table-striped table-bordered">
			<thead>
			    <tr class="tr-head">
			    	<th>Nome</th>
			    <!--	<th>Email</th> -->
			    	<th>Cidade</th>
              <!--      <th>Link Facebook</th> -->
			<!--    <th>Modificar</th>
			    	<th>Eliminar</th> -->
			    </tr>
			</thead>
			<tbody>
				<?php
					require_once("conect_mongo.php");

					if ($c_usuarios->count()>0)
					{
						$usuarios = $c_usuarios->find();
						foreach ($usuarios as $usuario) {
						
				?>
				<tr>
					<td><?php echo $usuario["Nome"]; ?></td>
				<!--	<td><?php echo $usuario["Email"]; ?></td> -->
					<td><?php echo $usuario["Cidade"]; ?></td>
                <!--    <td><a href = '<?php echo $usuario["Link_face"]; ?>' target="_blank">Link</a></td> -->
				<!--<td><a href="mod_usuario.php?id=<?php echo $usuario['_id'] ?>" class="btn btn-warning"><i class="icon-pencil icon-white"></i> Modificar</a></td>
					<td><a href="eliminar_usuario.php?id=<?php echo $usuario['_id'] ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i> Eliminar</a></td>-->
				</tr>
				<?php
						}
					}else{
				?>
				<tr>
					<td colspan="4"><h4><i class="icon-info-sign"></i> Sem registro na base de dados.</h4></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
        
        <?php } ?>

		<footer>
		  <p>Desenvolvido por: <a href="https://br.linkedin.com/pub/rodolfo-ruffer/42/643/1" target="_blank">Rodolfo Ruffer.</a></p>
		</footer>
	</div> <!-- /container -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
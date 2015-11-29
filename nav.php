<?php
session_start();
?>

<div class="navbar-inner">
	<div class="container">
	  <ul class="nav">
	    <li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Inicio</a></li>
        <li><a href="contatos.php">Contacte-me</a></li>
	    <li><a href="https://www.facebook.com/rodolfo.ruffer" target="_blank"><i class="icon-thumbs-up icon-white"></i> Rodolfo Ruffer</a></li>
        <?php if($_SESSION['logout'] != null){ ?>
           <li class="dropdown">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sair <span class="caret"></span></a>
              	<ul class="dropdown-menu" role="menu">
             		 <li><a href="logout.php">Logout</a></li>
              	</ul>
              </li>
        <?php } ?>  
	  </ul>
	</div>
</div>
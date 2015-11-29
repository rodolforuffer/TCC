<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es-CL">
  <head>
    <?php 
    	require_once("head.php");
    ?>
<style>
.container { 
	width: 940px; 
	margin: 0 auto; 
}
.row { margin-left: -20px; }
/* .span1 { 
	width: 60px; 
	float: left; 
	margin-left: 20px;  
	background: #d5d5d5
	}
*/
.row:after { 
	content: "";
	display: table;
	line-height: 0;
	clear:both;
}
[class*="span"] {
	float: left;
	margin-left: 20px;
}
.span4 { 
	width: 300px; 
}
.span8 { 
	width: 620px; 
}
</style>
<style type="text/css">
#buttonbg {width: 260px;margin: 10px 20px;padding: 0;} #buttonbg li {cursor: pointer;
height: 48px;position: relative;list-style-type: none;
}
#buttonbg .icon
{background: #D91E76 url('http://2.bp.blogspot.com/-JKB0aVYaIW0/UC-oBl8NXxI/AAAAAAAAEYA/IbgyikdkM5A/s1600/blsocial12.png') 0 0 no-repeat; background-color: rgba(217, 30, 118, .42);border-radius: 30px;display: block; color: #141414;float: none;height: 48px;line-height: 48px; margin: 5px 0;position: relative;text-align: left;text-indent: 90px; text-shadow: #333 0 1px 0;white-space: nowrap;width: 48px;z-index: 5; -webkit-transition: width .25s ease-in-out, background-color .25s ease-in-out; -moz-transition: width .25s ease-in-out, background-color .25s ease-in-out; -o-transition: width .25s ease-in-out, background-color .25s ease-in-out; transition: width .25s ease-in-out, background-color .25s ease-in-out; -webkit-box-shadow: rgba(0, 0, 0, .28) 0 2px 3px; -moz-box-shadow: rgba(0,0,0, .28) 0 2px 3px; -o-box-shadow: rgba(0,0,0, .28) 0 2px 3px; box-shadow: rgba(0, 0, 0, .28) 0 2px 3px; text-decoration: none;}
#buttonbg span:hover {visibility: hidden;}
#buttonbg span {display: block;top: 15px;position: absolute;left: 90px;}
#buttonbg .icon {color:
#fafafa;overflow: hidden;}
#buttonbg .fb {background-color: rgba(45,118,185, .42); background-position: 0 -382px;} #buttonbg .twit {background-color: rgba(0, 161, 223, .42); background-position: 0 -430px;}
#buttonbg .google {background-color: rgba(167, 0, 0, .42); background-position: 0 -478px;} #buttonbg .pint {background-color: rgba(204, 0, 0, .42);background-position: 0 -526px;}
#buttonbg .linked {background-color: rgba(0, 87, 114, .42); background-position: 0 -574px;} #buttonbg .deviant {background-color: rgba(76, 122, 74, .42); background-position: 0 -622px;}
#buttonbg .ytube {background-color: rgba(170, 0, 0, .42); background-position: 0 -670px;} #buttonbg .rss {background-color: rgba(255,109, 0, .42); background-position: 0 -718px;}
#buttonbg li:hover .icon {width: 250px; } #buttonbg li:hover .icon {background-color: #d91e76; }
#buttonbg li:hover .fb {
background-color: #2d76b9;background-position: 0 2px;}
#buttonbg li:hover .twit {background-color: #00A1DF; background-position: 0 -46px; }
#buttonbg li:hover .google {background-color: #A70000;background-position: 0 -94px;}
#buttonbg li:hover .pint {background-color: #C00;background-position: 0 -142px; } #buttonbg li:hover .linked {background-color: #005772;background-position: 0 -190px;}
 #buttonbg li:hover .deviant {background-color: #4C7A4A;background-position: 0 -238px;}
#buttonbg li:hover .ytube {background-color: #A00;background-position: 0 -286px; }
#buttonbg li:hover .rss {background-color: #EC5601;background-position: 0 -334px; }
#buttonbg .icon:active {bottom: -2px;-webkit-box-shadow: none;-moz-box-shadow: none;-o-box-shadow: none;}
</style>
  </head>
  <body>
  	<div class="navbar navbar navbar-inverse navbar-fixed-top">
	  <?php 
	  	require_once("nav.php");
	  ?>
      <?php if($_SESSION['logout'] != null){ 
               $nome  = $_SESSION['nome'];
               $email = $_SESSION['email'];
            } 
      ?>
	</div>
	<div class="container">
		<h2>Entre em contato por email ou pelas redes sociais.</h2>
        <div class="row"> 
        <div class="span8">
		<p class="text-info">Informe os dados abaixo:</p><br><br>
		<form class="form-horizontal" action="enviar_email.php" method="post">
		  	<div class="control-group">
		    	<label class="control-label" for="inputNameLibro">Nome</label>
		    	<div class="controls">
		      		<input type="text" name="nome" id="nome" class="input-xlarge" placeholder="Informe o seu Nome" value="<?php echo $nome; ?>"/>
		    	</div>
		  	</div>
            <div class="control-group">
		    	<label class="control-label" for="inputNameLibro">Email</label>
		    	<div class="controls">
		      		<input type="text" name="email" id="email" class="input-xlarge" placeholder="Informe seu Email" value="<?php echo $email; ?>"/>
		    	</div>
		  	</div>
            <div class="control-group">
		    	<label class="control-label" for="inputNameLibro">Assunto</label>
		    	<div class="controls">
		      		<input type="text" name="assunto" id="assunto" class="input-xlarge" placeholder="Informe o Assunto" />
		    	</div>
		  	</div>
		  	<div class="control-group">
		    	<label class="control-label" for="inputAutor">Mensagem</label>
		    	<div class="controls">
		      		<textarea name="text" id="text" rows="6" class="input-xlarge" placeholder="Digite a Mensagem"></textarea>
		    	</div>
		  	</div>
		  	<div class="control-group">
		    	<div class="controls">
		      		<button type="submit" class="btn btn-large btn-primary"><i class="icon-book icon-white"></i> Enviar</button>
                    <button type="reset"  class="btn btn-large btn-primary"><i class="icon-book icon-white"></i> Limpar</button>
		    	</div>
		  	</div>
		</form>
		<footer>
		  <p>Desenvolvido por: <a href="https://br.linkedin.com/pub/rodolfo-ruffer/42/643/1" target="_blank">Rodolfo Ruffer.</a></p>
		</footer>
        </div>
        <div class="span4">
          <p class="text-info">Redes Sociais:</p><br><br>
        <ul id="buttonbg">
        <li><a href="https://www.facebook.com/rodolfo.ruffer" class="icon fb" target="_blank">Facebook >>></a><span>Encontre-me no Facebook</span></li>
        <li><a href="https://twitter.com/kiwTkd" class="icon twit" target="_blank">Twitter >>></a><span>Siga-me no Twitter</span></li>
        <li><a href="https://plus.google.com/u/1/115396731787970439589" class="icon google" target="_blank">Google+ >>></a><span>Adiciona-me no Google+</span></li>
        <li><a href="https://br.linkedin.com/pub/rodolfo-ruffer/42/643/1" class="icon linked" target="_blank">Linkedin >>></a><span>Adiciona-me no Linkedin</span></li>
        </ul>
        </div>
      </div>
	</div> <!-- /container -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
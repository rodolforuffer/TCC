<?php
   session_start();
   
   ?>
<!DOCTYPE html>
<html lang="es-CL">
   <head>
      <?php 
         require_once("head.php");
         ?>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!--    <script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
         <script type='text/javascript' src='cep.js'></script> -->
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
      <!-- Adicionando JQuery -->
      <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
      <!-- Adicionando Javascript -->
      <script type="text/javascript" >
         $(document).ready(function() {
         
             function limpa_formulário_cep() {
                 // Limpa valores do formulário de cep.
                 $("#rua").val("");
                 $("#bairro").val("");
                 $("#cidade").val("");
                 $("#uf").val("");
                 $("#ibge").val("");
             }
             
             //Quando o campo cep perde o foco.
             $("#cep").blur(function() {
         
                 //Nova variável "cep" somente com dígitos.
                 var cep = $(this).val().replace(/\D/g, '');
         
                 //Verifica se campo cep possui valor informado.
                 if (cep != "") {
         
                     //Expressão regular para validar o CEP.
                     var validacep = /^[0-9]{8}$/;
         
                     //Valida o formato do CEP.
                     if(validacep.test(cep)) {
         
                         //Preenche os campos com "..." enquanto consulta webservice.
                         $("#rua").val("aguarde...")
                         $("#bairro").val("aguarde...")
                         $("#cidade").val("aguarde...")
                         $("#uf").val("aguarde...")
                         $("#ibge").val("aguarde...")
         
                         //Consulta o webservice viacep.com.br/
                         $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
         
                             if (!("erro" in dados)) {
                                 //Atualiza os campos com os valores da consulta.
                                 $("#rua").val(dados.logradouro);
                                 $("#bairro").val(dados.bairro);
                                 $("#cidade").val(dados.localidade);
                                 $("#uf").val(dados.uf);
                                 $("#ibge").val(dados.ibge);
                             } //end if.
                             else {
                                 //CEP pesquisado não foi encontrado.
                                 limpa_formulário_cep();
                                 alert("CEP não encontrado.");
                             }
                         });
                     } //end if.
                     else {
                         //cep é inválido.
                         limpa_formulário_cep();
                         alert("Formato de CEP inválido.");
                     }
                 } //end if.
                 else {
                     //cep sem valor, limpa formulário.
                     limpa_formulário_cep();
                 }
             });
         });
         
      </script>      
   </head>
   <body>
      <div class="navbar navbar navbar-inverse navbar-fixed-top">
         <?php 
            require_once("nav.php");
            ?>
      </div>
      <div class="container">
         <div class="row">
            <div class="span8">
               <h2>Informe seus dados <?php echo $_SESSION['nome']?>:</h2>
               <p class="text-info">Este formulário conta com os recursos do <a href="https://developers.facebook.com/products/login" target="_blank"><u><b>Facebook Login</b></u></a> e do webservice <a href="https://viacep.com.br/" target="_blank"><u><b>Via Cep</b></u></a>.</p>
               <form class="form-horizontal" action="gravar_dados.php" method="post">
                  <div class="control-group">
                     <label class="control-label" for="inputNameAutor">Nome</label>
                     <div class="controls">
                        <input type="text" name="nome" id="nome" class="input-xlarge" placeholder="Nome" value="<?php echo $_SESSION['nome']; ?>"/>
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">Sexo</label>
                     <div class="controls">
                        <input type="text" name="sexo" id="sexo" class="input-xlarge" placeholder="Feminino ou Masculino" value="<?php echo $_SESSION['sexo']; ?>"/>
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">Data de Nascimento</label>
                     <div class="controls">
                        <input type="text" name="data_nascimento" id="data_nascimento" class="input-xlarge" placeholder="Data de Nascimento ex: 25/08/1983" value="<?php echo $_SESSION['data_nascimento']; ?>"/>
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">Email</label>
                     <div class="controls">
                        <input type="text" name="email" id="email" class="input-xlarge" placeholder="Email" value="<?php echo $_SESSION['email']; ?>"/>
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">CEP</label>
                     <div class="controls">
                        <input type="text" name="cep" id="cep" class="input-xlarge" placeholder="Somente números Ex.: 12345678" />
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">Rua</label>
                     <div class="controls">
                        <input type="text" name="rua" id="rua" class="input-xlarge" placeholder="Rua" />
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">Bairro</label>
                     <div class="controls">
                        <input type="text" name="bairro" id="bairro" class="input-xlarge" placeholder="Bairro" />
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">Cidade</label>
                     <div class="controls">
                        <input type="text" name="cidade" id="cidade" class="input-xlarge" placeholder="Cidade" />
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">UF</label>
                     <div class="controls">
                        <input type="text" name="uf" id="uf" class="input-xlarge" placeholder="UF ex: RJ" />                 
                     </div>
                     <br />
                     <label class="control-label" for="inputNameAutor">IBGE</label>
                     <div class="controls">
                        <input type="text" name="ibge" id="ibge" class="input-xlarge" placeholder="Campo não obrigatório" />                 
                     </div>
                     <br />
                  </div>
                  <div class="control-group">
                     <div class="controls">
                        <button type="submit" class="btn btn-large btn-primary"><i class="icon-user icon-white"></i> Salvar Dados</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="span4">
               <br /><br /><br /><br /><br /><br /><br /><br />
               <img src="https://graph.facebook.com/<?php echo $_SESSION['id']; ?>/picture?type=large">
            </div>
         </div>
         <footer>
            <p>Desenvolvido por: <a href="https://br.linkedin.com/pub/rodolfo-ruffer/42/643/1" target="_blank">Rodolfo Ruffer.</a></p>
         </footer>
      </div>
      <!-- /container -->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>
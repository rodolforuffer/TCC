<?php
// incluir o sdk do facebook
require 'facebook-php-sdk-master/src/facebook.php';
  
// Configure abaixo o appId e secret do seu aplicativo
$facebook = new Facebook(array(
  'appId'  => '1626914787539438',
  'secret' => 'a8be139b93eb4090e1527f6e25f91981',
));
  

        // usuario não logado, solicitar autenticação
        $loginUrl = $facebook->getLoginUrl(array(“scope” => “publish_stream,user_about_me,email”));
        echo "<a href='$loginUrl'>Conectar no aplicativo</a><br />";
        echo "<strong><em>Voc&ecirc; n&atilde;o esta conectado..</em></strong>";

<?php

// Cria a instancia da aplicacao, informando o appid e o secret
$facebook = new Facebook(array(
  '1626914787539438'  => $APP_ID,
  'a8be139b93eb4090e1527f6e25f91981' => $SECRET,
));

// obtem o id do usuario
$user = $facebook->getUser();

if ($user) { // usuario logado
        try {
        $permissions = $facebook->api("/me/permissions");

        // tratar permissoes
        $permissions_granted = array();
        foreach($permissions['data'] as $perm) {
                array_push($permissions_granted, $perm['permission']);
        }

        if(!in_array('email', $permissions_granted)
                || !in_array('user_likes', $permissions_granted)
                || !in_array('publish_actions', $permissions_granted)) {

                header("Location: " . $facebook->getLoginUrl(array("scope" => "email, user_likes, publish_actions")));
                exit;
        }

        // Obtem dados do usuario logado
        $user_profile = $facebook->api('/me');

        // exibe foto do usuario logado
        echo "<img src=\"https://graph.facebook.com/$user/picture\">";

        // printa os dados do profile do usuario logado
        echo "<pre>";
        print_r($user_profile);
        echo "</pre>";

        } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
        }
} else {
        // usuario nao logado, solicitar autenticacao e permissao
        $loginUrl = $facebook->getLoginUrl(array("scope" => "email, user_likes, publish_actions"));
        header("Location: $loginUrl");
}
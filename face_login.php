<?php

date_default_timezone_set('UTC');
//setlocale (LC_ALL, 'nl_NL');

//1.Stat Session
session_start();

require_once( 'lib/Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'lib/Facebook/HttpClients/FacebookCurl.php' );
require_once( 'lib/Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'lib/Facebook/Entities/AccessToken.php' );
require_once( 'lib/Facebook/Entities/SignedRequest.php');
require_once( 'lib/Facebook/FacebookSession.php' );
require_once( 'lib/Facebook/FacebookSignedRequestFromInputHelper.php');
require_once( 'lib/Facebook/FacebookCanvasLoginHelper.php');
require_once( 'lib/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'lib/Facebook/FacebookRequest.php' );
require_once( 'lib/Facebook/FacebookResponse.php' );
require_once( 'lib/Facebook/FacebookSDKException.php' );
require_once( 'lib/Facebook/FacebookRequestException.php' );
require_once( 'lib/Facebook/FacebookOtherException.php' );
require_once( 'lib/Facebook/FacebookAuthorizationException.php' );
require_once( 'lib/Facebook/GraphObject.php' );
require_once( 'lib/Facebook/GraphUser.php');
require_once( 'lib/Facebook/GraphSessionInfo.php' );

/* USE NAMESPACES */
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use WideImage;
	 
	//2.Use app id,secret and redirect url
	 $app_id = '';
	 $app_secret = '';
	 $redirect_url='http://tccmineracaodedados.com/';
	 
	 //3.Initialize application, create helper object and get fb sess
	 FacebookSession::setDefaultApplication($app_id,$app_secret);
	 $helper = new FacebookRedirectLoginHelper($redirect_url);
	 $session = $helper->getSessionFromRedirect();

	    //4. if fb sess exists echo name 
	 	if(isset($session)){
            
            //create request object,execute and capture response
		    $requestUser = new FacebookRequest($session, 'GET', '/me');
            
		    // from response get graph object
		    $responseUser = $requestUser->execute();
		    $graphUser = $responseUser->getGraphObject(GraphUser::className());
            
	    	// use graph object methods to get user details
	     	$_SESSION['nome'] = $graphUser->getName();
            $_SESSION['id']  = $graphUser->getId();
            $id_face = $graphUser->getId();
            $_SESSION['link_foto']  = 'https://graph.facebook.com/'.$id.'/picture?width=300';
            $_SESSION['email']  = $graphUser->getProperty('email');
            $sexo =  $graphUser->getProperty('gender');
            $_SESSION['fuso_horario']  = $graphUser->getProperty('timezone');
            $_SESSION['verificado']  = $graphUser->getProperty('verified');
            $_SESSION['link_perfil']  = $graphUser->getProperty('link');
            
            $data_nascimento = $graphUser->getProperty("birthday");
            $_SESSION['data_nascimento'] = date('d/m/Y', strtotime($data_nascimento));
           
            if($sexo == "male"){
                $_SESSION['sexo']  = "Masculino";
            }else if($sexo == "female"){
                $_SESSION['sexo']  = "Feminino";
            }

            $_SESSION['fb_amigos']  = (new FacebookRequest( $session, 'GET', '/me/friends' ))->execute()->getGraphObject()->asArray();
   

            $mongo = new Mongo();
	        $db = $mongo->selectDB("db");
	        $c_usuarios = $mongo->selectCollection($db,"dados_usuarios");
            $condicion = $c_usuarios->find(array("Id_face" => $id_face));
            
            if ($condicion->count() != 0){
                $_SESSION['logout'] = $id_face;
                header("Refresh: 0;url=index.php?msg=5");
            }else{
                header("Location: formulario.php");  
            }   

	}else{

		echo '<a href='.$helper->getLoginUrl(array('email, user_friends, user_posts, user_birthday')).'><img src="fotos/facebook_login.gif"/></a>';

	}
?>

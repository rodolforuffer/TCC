<?php

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

/*PROCESS*/
	
	//1.Stat Session
	 
	//2.Use app id,secret and redirect url
	 $app_id = '1626914787539438';
	 $app_secret = 'a8be139b93eb4090e1527f6e25f91981';
	 $redirect_url='http://tcc-data-mining.herokuapp.com/';
	 
	 //3.Initialize application, create helper object and get fb sess
	 FacebookSession::setDefaultApplication($app_id,$app_secret);
	 $helper = new FacebookCanvasLoginHelper();

     try {
	 $session = $helper->getSession();
     } catch (FacebookRequestException $ex) {
	     echo $ex->getMessage();
     } catch (\Exception $ex) {
	     echo $ex->getMessage();
     }
	//4. if fb sess exists echo name 
	 	if(isset($sess)){
		//Acess long token
		// User logged in, get the AccessToken entity.
        $accessToken = $session->getAccessToken();
        // Exchange the short-lived token for a long-lived token.
        $longLivedAccessToken = $accessToken->extend();
        // Now store the long-lived token in the database
        // . . . $db->store($longLivedAccessToken);
        // Make calls to Graph with the long-lived token.
        // . . . 
	 		//create request object,execute and capture response
		$request = new FacebookRequest($sess, 'GET', '/me');
		// from response get graph object
		$response = $request->execute();
		$graph = $response->getGraphObject(GraphUser::className());
		// use graph object methods to get user details
		$name= $graph->getName();
		echo "Olá $name";
	}else{
		//else echo login
		$helper = new FacebookRedirectLoginHelper('http://tcc-data-mining.herokuapp.com/');
		$auth_url = $helper->getLoginUrl(array('email, user_friends'));
	    echo "<script>window.top.location.href='".$auth_url."'</script>";
		//echo '<a href='.$helper->getLoginUrl(array('email, user_friends, user_posts')).'>Logando com o facebook</a>';
	}

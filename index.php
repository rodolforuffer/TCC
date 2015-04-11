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

$facebook = FacebookSession::setDefaultApplication('1626914787539438','a8be139b93eb4090e1527f6e25f91981');
$helper = new FacebookCanvasLoginHelper();

try {
	$session = $helper->getSession();
} catch (FacebookRequestException $ex) {
	echo $ex->getMessage();
} catch (\Exception $ex) {
	echo $ex->getMessage();
}

if ($session) {
	try {
		// $request = new FacebookRequest($session, 'GET', '/me');
		// $response = $request->execute();
		// $me = $response->getGraphObject();
		// echo $me->getProperty('name');
		} catch(FacebookRequestException $e) {
		echo $e->getMessage();
	}
} else {
	$helper = new FacebookRedirectLoginHelper('https://apps.facebook.com/tccmineracaodedados/');
	$auth_url = $helper->getLoginUrl(array('email'));
	echo "<script>window.top.location.href='".$auth_url."'</script>";
}

<?php
/*	FACEBOOK LOGIN BASIC - PHP SDK V4.0
 *	file 			- index.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://packetcode.com/apps/fblogin-basic/
 *	Date 			- 27th Sept 2014
 *	license			- GNU General Public License version 2 or later
*/

/* INCLUSION OF LIBRARY FILEs*/
	require_once( 'lib/Facebook/FacebookSession.php');
	require_once( 'lib/Facebook/FacebookRequest.php' );
	require_once( 'lib/Facebook/FacebookResponse.php' );
	require_once( 'lib/Facebook/FacebookSDKException.php' );
	require_once( 'lib/Facebook/FacebookRequestException.php' );
	require_once( 'lib/Facebook/FacebookRedirectLoginHelper.php');
	require_once( 'lib/Facebook/FacebookAuthorizationException.php' );
	require_once( 'lib/Facebook/GraphObject.php' );
	require_once( 'lib/Facebook/GraphUser.php' );
	require_once( 'lib/Facebook/GraphSessionInfo.php' );
	require_once( 'lib/Facebook/Entities/AccessToken.php');
	require_once( 'lib/Facebook/HttpClients/FacebookCurl.php' );
	require_once( 'lib/Facebook/HttpClients/FacebookHttpable.php');
	require_once( 'lib/Facebook/HttpClients/FacebookCurlHttpClient.php');

/* USE NAMESPACES */

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\GraphUser;
	use Facebook\GraphSessionInfo;
	use Facebook\FacebookHttpable;
	use Facebook\FacebookCurlHttpClient;
	use Facebook\FacebookCurl;

/*PROCESS*/

	 FacebookSession::setDefaultApplication('1626914787539438','a8be139b93eb4090e1527f6e25f91981');
	 $helper = new FacebookCanvasLoginHelper();
	 
	 try{
	 	$session = $helper->getSession();
	 }catch (FacebookRequestException $e){
	 	echo  $getMessage();
	 }catch (\Exception $ex){
	 	echo $e->getMessage();
	 }
	 
	 if ($session){
	 	try{
	 		$request = new FacebookRequest($session, 'GET', '/me');
	 		$response = $request->execute();
	 		$me = $response->getGraphObject();
	 		echo $me->getProperty('name');
	 	}catch (FacebookRequestException $e){
	 		echo $e->getMessage();
	 	}
	 }else{
	 	$helper = new FacebookRedirectLoginHelper('https://apps.facebook.com/tccmineracaodedados/');
	 	$auth_url = $helper->getLoginUrl(array('email','user_friends'));
	 	echo "<script>window.top.location.href='".$auth_url."'</script>";
	 }


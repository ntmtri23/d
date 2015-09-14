<?php

// Set the location of the Facebook PHP SDK - this should point to directory containing autoload.php
define( 'FACEBOOK_SDK_V4_SRC_DIR', './Facebook/' );

// include required files from Facebook SDK
require_once( 'facebook/autoload.php' );

// start the session
session_start();

// setup application using API keys and handlers
$fb = new Facebook\Facebook([
  'app_id' => '1616272128625137',
  'app_secret' => 'e9cffe45e3f14a54dc0d311ed3efb4b2',
  'http_client_handler' => 'curl', // can be changed to stream or guzzle
  'persistent_data_handler' => 'session' // make sure session has started
]);

// login helper with redirect_uri
$helper = $fb->getRedirectLoginHelper();
$userid = $fb->getUser();
var_dump($userid);die();
// see if we have a code in the URL
if ( isset( $_GET['code'] ) ) {
  
  // get new access token if we've been redirected from login page
  try {
    // get access token
    //$access_token = $helper->getAccessToken();
    var_dump($access_token);
    die();
    // save access token to persistent data store
    $helper->getPersistentDataHandler()->set( 'access_token', $access_token );
  } catch ( Exception $e ) {
    echo($e);
  }

}

// get stored access token
$access_token = $helper->getPersistentDataHandler()->get( 'access_token' );

// check if we have an access_token, and that it's valid
if ( $access_token && !$access_token->isExpired() ) {
  
  // set default access_token so we can use it in any requests
  $fb->setDefaultAccessToken( $access_token );

  try {
    // If you provided a 'default_access_token', second parameter '{access-token}' is optional.
    $response = $fb->get( '/me' );
    // use $fb->post() to make a POST API call
  } catch( Exception $e ) {
    // catch any errors and halt script
    echo $e->getMessage();
    exit;
  }
  
  $me = $response->getGraphUser();
  
  echo '<p>Logged in as ' . $me->getName() . '</p>';
  
  echo '<pre>' . print_r( $me, 1 ) . '</pre>';
  
  echo '<p><a href="' . $helper->getLogoutUrl( $access_token, 'http://fbappapp.herokuapp.com/logout.php' ) . '">Logout of Facebook</a></p>';

} else {
  // show login link
  echo '<a href="' . $helper->getLoginUrl( 'http://fbappapp.herokuapp.com/', ['email'] ) . '">Login using Facebook</a>';
}

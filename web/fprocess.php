<?php
session_start();
// Set the location of the Facebook PHP SDK - this should point to directory containing autoload.php
define( 'FACEBOOK_SDK_V4_SRC_DIR', './Facebook/' );
// include required files from Facebook SDK
require_once( 'facebook/autoload.php' );
// setup application using API keys and handlers
$fb = new Facebook\Facebook([
  'app_id' => '1616272128625137',
  'app_secret' => 'e9cffe45e3f14a54dc0d311ed3efb4b2',
  'http_client_handler' => 'curl', // can be changed to stream or guzzle
  'persistent_data_handler' => 'session' // make sure session has started
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
$loginUrl = $helper->getLoginUrl('http://fbappapp.herokuapp.com/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
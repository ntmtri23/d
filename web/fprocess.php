<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
phpinfo();die();
try
{
    session_start();
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
}
catch(exception $ex)
{
    var_dump($ex);
}
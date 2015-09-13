<?php
    session_start();
    require_once 'facebook/autoload.php';
    require_once 'facebook/Facebook.php'; 

    
    $fb = new Facebook\Facebook([
      'app_id' => '317915161665904',
      'app_secret' => '8b0cefa9b50d1a02612d9d07c9a3f314',
      'default_graph_version' => 'v2.4',
    ]);
    $helper = $fb->getCanvasHelper();
    $sr = $helper->getSignedRequest();
 
    // Get the user ID if signed request exists
    $user = $sr ? $sr->getUserId() : null;
    var_dump($sr);
?>
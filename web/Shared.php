<?php 
    session_start();
    require_once( 'facebook/autoload.php' );
    $fb = new Facebook\Facebook([
          'app_id' => '1616272128625137',
          'app_secret' => 'e9cffe45e3f14a54dc0d311ed3efb4b2',
          'http_client_handler' => 'curl', // can be changed to stream or guzzle
          'persistent_data_handler' => 'session' // make sure session has started
        ]);
    $accessToken = isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '';
    $params = array(
          "access_token" => $accessToken,
          "message" => "Chuong trình quay s? trúng thu?ng trathuong.com",
          "link" => "http://demo.trathuong.com",
          "picture" => "http://www.upsieutoc.com/images/2015/09/28/bg_left.png",
          "name" => "Chuong trình quay s? trúng thu?ng",
          "caption" => "www.trathuong.com",
          "description" => "Chúng tôi cung c?p các gi?i pháp v? tr? thu?ng, liên h? ngay hôm nay d? nh?n du?c uu dãi setup h? th?ng và tu v?n nhi?u k?ch b?n ?ng d?ng."
        );
        
    try {
      $ret = $fb->post('/me/feed', $params);
    } catch(Exception $e) {
      echo $e->getMessage();
    }
?>
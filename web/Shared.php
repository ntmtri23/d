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
          "message" => "Chương trình quay số trúng thưởng trathuong.com",
          "link" => "https://apps.facebook.com/luckydraw-app/",
          "picture" => "http://www.upsieutoc.com/images/2015/09/28/bg_left.png",
          "name" => "Chương trình quay số trúng thưởng",
          "caption" => "www.trathuong.com",
          "description" => "Chúng tôi cung cấp các giải pháp về trả thưởng, liên hệ ngay hôm nay để nhận được ưu đãi setup hệ thống và tư vấn nhiều kịch bản ứng dụng."
        );
        
    try {
      $ret = $fb->post('/me/feed', $params);
      header('Location: login-callback.php');
    } catch(Exception $e) {
      echo $e->getMessage();
    }
?>
<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once( 'facebook/autoload.php' );
    try
    {
            $fb = new Facebook\Facebook([
              'app_id' => '1616272128625137',
              'app_secret' => 'e9cffe45e3f14a54dc0d311ed3efb4b2',
              'http_client_handler' => 'curl', // can be changed to stream or guzzle
              'persistent_data_handler' => 'session' // make sure session has started
            ]);
            $helper = $fb->getRedirectLoginHelper();
            try {
              $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }
            if (isset($accessToken)) {
              // Logged in!
              $_SESSION['facebook_access_token'] = (string) $accessToken;
              //var_dump($_SESSION['facebook_access_token']);
              $response = $fb->get('/me', $_SESSION['facebook_access_token']);
              // Exchange the short-lived token for a long-lived token.
              $me = $response->getGraphUser();
        }
    }
    catch(exception $ex)
    {
        var_dump($ex);
    }
  
?>
<div>
    <?php echo 'Chao ban ' . $me->getName(); ?>
</div>
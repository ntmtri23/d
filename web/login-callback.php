<link rel="stylesheet" href="css/main.css" type="text/css" />
<script type='text/javascript' src='js/winwheel_1.2.js'></script>
<script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
	$(document).ready(function () {
		$('.fancybox').fancybox();
	});
    
    $("#various2").fancybox({
        'modal': true
    });
    
</script>

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
    <a id="various2" href="#inline2" style="display:none;" class="show-result-spin">#EE</a>
    <div id="inline2" class="message-complete" style="width:550px;height:350px;background:url('img/bgresult.png');padding-left:20px;padding-top:50px;color:#ffffff;padding-right:20px;text-align:justify;line-height:30px;display:none;">
        <?php echo 'B?n s? tham gia trò choi v?i tu cách là : ' . $me->getName(); ?>
    </div>
</div>

<script type="text/javascript">
     $('.show-result-spin').click();
</script>

<html>
<head>
    <!-- bat buoc -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- nhung bootstrap -->
    <title>Demo bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="Bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="Bootstrap/css/sticky-footer.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="Bootstrap/css/theme.css" rel="stylesheet">
    <link href="Bootstrap/css/site.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="Bootstrap/js/bootstrap.min.js"></script>      
    <script type='text/javascript' src='js/winwheel_1.2.js'></script>
    <script type="text/javascript">
   
    </script>
</head>

<?php
    session_start();
    require_once( 'facebook/autoload.php' );
    define("LUCKY_DRAW_ID","401a0f70-cc1d-e511-941c-001c42aaff6e");
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
          $response = $fb->get('/me',array('fields' => 'id,name,gender,link,picture,age_range'), $_SESSION['facebook_access_token']);
          // Exchange the short-lived token for a long-lived token.
          $_SESSION['CurrentLoginUser'] = $response->getGraphUser();
          var_dump($_SESSION['CurrentLoginUser']);
        }
    }
    catch(exception $ex)
    {
        //var_dump($ex);
    }
    //header('Location:https://apps.facebook.com/luckydraw-app');
    $itemList = '';
    $itemR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetItemList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
	foreach($itemR->LuckyDrawItemModel as $item)
	{
	   $itemList = $itemList . ',' . $item->ItemName;
	}
    $resultR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetHistoryList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
?>
</html>

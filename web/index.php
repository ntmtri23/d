<link rel="stylesheet" href="css/main.css" type="text/css" />
<script type='text/javascript' src='js/winwheel_1.2.js'></script>
<script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
	$(document).ready(function () {
		$('.fancybox').fancybox();
	});
</script>

<?php

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
    $permissions = ['email','user_birthday']; // optional
    $loginUrl = $helper->getLoginUrl('https://fbappapp.herokuapp.com/login-callback.php', $permissions);
    
    echo '<a href="' . $loginUrl . '" target="_top">Log in with Facebook!</a>';
}
catch(exception $ex)
{
    var_dump($ex);
	echo 111;
}
?>

<script type="text/javascript">
    function PreSpin() {
		window.location = "<?php echo $loginUrl; ?>"
    }
</script>

<div class="row">
    <div class="the_wheel" align="center" valign="center" style="width:760px;height:582px;padding-top:100px; border-top:1px solid #d9ac1a;-webkit-box-shadow: 2px 1px 22px 7px rgba(0,0,0,0.75);-moz-box-shadow: 2px 1px 22px 7px rgba(0,0,0,0.75);box-shadow: 2px 1px 22px 7px rgba(0,0,0,0.75);float:left;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;background:url('img/bg006.jpg')">
        <canvas class="the_canvas" id="myDrawingCanvas" width="434" height="434" onclick="PreSpin();" style="cursor:pointer;">
            <p class="noCanvasMsg" align="center">Ôi không?.Trình duy?t c?a b?n không h? tr? html5<br />Hãy nâng c?p nó.</p>
        </canvas>
    </div>
    <a href="<?php echo $loginUrl; ?>" class="show-form-infomation fancybox fancybox.ajax" style="display: none;">#EE</a>
    <a id="various2" href="#inline2" style="display:none;" class="show-result-spin">#EE</a>
    <input type="hidden" value="@ViewBag.LuckyDrawId" id="lkdit" />
    <input type="hidden" value="img/luckydrawab3.png" id="spinImagePath" />
    <div id="inline2" class="message-complete" style="width:550px;height:350px;background:url('img/bgresult.png');padding-left:20px;padding-top:50px;color:#ffffff;padding-right:20px;text-align:justify;line-height:30px;display:none;">
    </div>
    <a href="api.php"></a>
</div>
<script type="text/javascript">
    var lkdit = $("#lkdit").val();
    var spinImagePath = $("#spinImagePath").val();
    begin(spinImagePath);
    var itemList = $('#itemNameList').val();
    initialVariable(itemList, lkdit);
</script>

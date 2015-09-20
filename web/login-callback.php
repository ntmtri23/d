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
    
    $("#various3").fancybox({
        'modal': true
    });
    
</script>

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
          $response = $fb->get('/me', $_SESSION['facebook_access_token']);
          // Exchange the short-lived token for a long-lived token.
          $_SESSION['CurrentLoginUser'] = $response->getGraphUser();
        }
    }
    catch(exception $ex)
    {
        var_dump($ex);
    }
    $itemList = '';
    $xml = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetItemList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
	foreach($xml->LuckyDrawItemModel as $item)
	{
	   $itemList = $itemList . ',' . $item->ItemName;
	}
?>

<div class="row">
    <div class="the_wheel" align="center" valign="center" style="width:760px;height:582px;padding-top:100px; border-top:1px solid #d9ac1a;-webkit-box-shadow: 2px 1px 22px 7px rgba(0,0,0,0.75);-moz-box-shadow: 2px 1px 22px 7px rgba(0,0,0,0.75);box-shadow: 2px 1px 22px 7px rgba(0,0,0,0.75);float:left;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;background:url('img/bg006.jpg')">
        <canvas class="the_canvas" id="myDrawingCanvas" width="434" height="434" onclick="startSpin();" style="cursor:pointer;">
            <p class="noCanvasMsg" align="center">Ôi không?.Trình duy?t c?a b?n không h? tr? html5<br />Hãy nâng c?p nó.</p>
        </canvas>
    </div>
    <a href="<?php echo $loginUrl; ?>" class="show-form-infomation fancybox fancybox.ajax" style="display: none;">#EE</a>
    <a id="various2" href="#inline2" style="display:none;" class="show-result-spin">#EE</a>
    <input type="hidden" value="img/luckydrawab3.png" id="spinImagePath" />
    <input type="hidden" value="<?php echo $itemList; ?>" id= "itemNameList" />
    <div id="inline2" class="message-complete" style="width:550px;height:350px;background:url('img/bgresult.png');padding-left:20px;padding-top:50px;color:#ffffff;padding-right:20px;text-align:justify;line-height:30px;display:none;">
    </div>
</div>

<script type="text/javascript">
    var spinImagePath = $("#spinImagePath").val();
    begin(spinImagePath);
    var itemList = $('#itemNameList').val();
    initialVariable(itemList, '401a0f70-cc1d-e511-941c-001c42aaff6e');
</script>

<div>
    <a id="various2" href="#inline2" style="display:none;" class="show-infomation-form">#EE</a>
    <div id="inline2" style="padding-left:20px;padding-top:50px;color:#ffffff;padding-right:20px;text-align:justify;line-height:30px;display: none;">
        <div class="panel-body">
            <div class="example-box-wrapper">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tên của bạn</label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $me->getName(); ?>" name="FullName" id="FullName" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Điện thoại</label>
                    <div class="col-sm-8">
                        <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder = "Nhập số điện thoại của bạn..." />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" name="EmailAddress" id="EmailAddress" placeholder = "Nhập email của bạn..." />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4" style="text-align:right;">
                        &nbsp;
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success save-data" type="button">Chơi ngay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a id="various3" href="#inline3" style="display:none;" class="show-result-form">#EE</a>
    <div id="inline3" class="message-complete" style="padding-left:20px;padding-top:50px;color:#ffffff;padding-right:20px;text-align:justify;line-height:30px;display:none;">
        
    </div>
</div>

<script type="text/javascript">
     $('.show-infomation-form').click();
     $('.save-data').click(function(){
        $.fancybox.close();
        $('.show-result-form').click();
        $('.message-complete').html("<a href = '#share'><img src = 'img/facebook_share.png'></a><br /><span style = 'font-size:24pt;text-shadow: 2px 2px #ff0000;'>CHÚC MỪNG</span><br /><span style = 'font-size:16pt;text-shadow: 2px 2px #ff0000;'>Bạn vừa quay được <span style = 'font-weight:bold;font-size:18pt;'> [ 1 CHUYẾN DU LỊCH THÁI LAN CHO 2 NGƯỜI TRỊ GIÁ 25 TRIỆU ĐỒNG ] </span></span>.<br /> <span style = 'font-size:16pt;text-shadow: 2px 2px #ff0000;'>Cảm ơn bạn đã tham gia chương trình.</span> <br /><span style = 'font-size:16pt;text-shadow: 2px 2px #ff0000;'>Giải thưởng sẽ được chuyển đến bạn trong thời gian sớm nhất.</span><br /><br /> <a class = 'btn btn-default' href='javascript:;' onclick='$.fancybox.close();'>Hoàn tất</a>")
     });
</script>

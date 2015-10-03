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
          $response = $fb->get('/me', $_SESSION['facebook_access_token']);
          // Exchange the short-lived token for a long-lived token.
          $_SESSION['CurrentLoginUser'] = $response->getGraphUser();
        }
    }
    catch(exception $ex)
    {
        //var_dump($ex);
    }
    $itemList = '';
    $itemR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetItemList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
	foreach($itemR->LuckyDrawItemModel as $item)
	{
	   $itemList = $itemList . ',' . $item->ItemName;
	}
    $resultR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetHistoryList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
?>

<body>
    <!-- container -->
    <div class="container">
        <!-- tao tung khung  -->
        <div class="row">
            <div class="col-md-12 no-padding" style="background-color:#ff0;">
                <!-- right panel -->
                <div class="box">
                    <div class="box-header">
                        	<div class="pull-right" style="margin:15px 50px 15px 0;">
                            	<div class="col-xs-1 pull-right"><button type="button" class="btn btn_youtube"></button></div>
                                <div class="col-xs-2 pull-right"><button type="button" class="btn btn_facebook"></button></div>
                                <div class="col-xs-2 pull-right"><button type="button" class="btn btn_like"></button></div>
                            	<div class="col-xs-4 pull-right share">
                                    <a href="Shared.php" class="btn btn_share">CHIA S?</a>
                                </div>                               
                            </div>
                            <!-- /.khong chia-->                                              
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!-- chia lam hai -->
                        <div class="col-xs-12 col-sm-6" id="sideRound">
                            <!-- chia lam ba--> 
                            <div class="quayso">
                            <!-- TR�NG GI?I -->
                            <div class="trunggiai">                            	
                                <button style="display: none;" class="btn btn-primary show-result" data-toggle="modal" data-target="#modal-2">TR�NG GI?I</button>
                                <div id="modal-2" class="modal" tabindex="-1" role="dialog">
                                  <div class="modal-dialog">
                                    <div class="modal-content cus-mo-content">
                                      <div class="modal-header cus-modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>�</span></button>                                        
                                      </div>
                                      <div class="modal-body">
                                        <h2 class="modal-title" style="font-weight:bold;color:#3f4547;">CH�C M?NG B?N</h2>
                                        <span style="font-size:16pt;">B?n v?a quay du?c <span style="font-weight:bold;font-size:18pt;color:#b2e21e;" class="data-result-val">  </span></span><br>
                                        <span style="font-size:16pt;">C?m on b?n d� tham gia chuong tr�nh.</span><br>
                                        <span style="font-size:16pt;">Gi?i thu?ng s? du?c g?i d?n b?n trong th?i gian s?m nh?t.</span><br>
                                        <span style="font-size:16pt;">B?N C�N <span style="font-weight:bold; font-size:50px;color:#ffc600;">10</span> LU?T QUAY</span>
                                      </div>                                      
                                      <div class="modal-footer cus-modal-footer">
                                        <button type="button" class="btn btn-link cus-btn" data-dismiss="modal">QUAY TI?P</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>                                                                 
                            </div> 
                            <!-- END TR�NG GI?I -->                                                    
                                <div class="bg_left">
                                    <div class="table_quay">
                                        <canvas class="the_canvas img-responsive" id="myDrawingCanvas" width="434" height="434" onclick="PreSpin();" style="cursor:pointer;">
                                            <p class="noCanvasMsg" align="center">�i kh�ng?.Tr�nh duy?t c?a b?n kh�ng h? tr? html5<br />H�y n�ng c?p n�.</p>
                                        </canvas>
                                    	<!-- click quay -->
                                        <button type="button" class="btn btn-link btn_quay" data-toggle="modal" data-target="#myModal"></button>                
                                          <!-- Modal -->
                                          <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">                                            
                                              <!-- THONG TIN-->
                                              <div class="modal-content custom-modal-content">
                                                <div class="modal-header custom-modal-header">
                                                  <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">NH?P TH�NG TIN</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" role="form">
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">T�n B?n</label>
                                                          <div class="col-sm-9">
                                                            <input class="form-control custom-form-control" name="UserName" id="UserName" type="text" placeholder="T�n B?n">
                                                            <label style="display: none;color:red;" class="UserName_Err">Vui l�ng nh?p t�n c?a b?n</label>
                                                          </div>
                                                        </div>
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">�i?n tho?i</label>
                                                          <div class="col-sm-9">
                                                            <input class="form-control custom-form-control" name="PhoneNumber" id="PhoneNumber" type="text" placeholder="�i?n tho?i">
                                                            <label style="display: none;color:red;" class="PhoneNumber_Err">Vui l�ng nh?p SDT c?a b?n</label>
                                                          </div>
                                                        </div>
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">Email</label>
                                                          <div class="col-sm-9">
                                                            <input class="form-control custom-form-control" id="EmailAddress" name="EmailAddress" type="text" placeholder="Email">
                                                            <label style="display: none;color:red;" class="EmailAddress_Err">Vui l�ng nh?p email c?a b?n</label>
                                                          </div>
                                                        </div>
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">�?a ch? nh?n thu?ng</label>
                                                          <div class="col-sm-9">
                                                            <textarea class="form-control custom-form-textarea" rows="5" id="Address" name="Address" placeholder="�?a ch? nh?n thu?ng"></textarea>
                                                            <label style="display: none;color:red;" class="Address_Err">Vui l�ng nh?p d?a ch? c?a b?n</label>
                                                          </div>
                                                        </div>
                                                        <div class="pull-right">          
                                                        <button type="button" class="btn custom-btn spin-now">Quay Th�i</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                      </form>
                                                </div>
                                              </div>
                                              
                                            </div>
                                          </div>
                                        <!-- CLICK QUAY--> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 sidebar-offcanvas" id="Awars">
                            <!-- tabs -->
                            <div class="comment">                                	                              
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box  -->
                                <ul class="nav nav-tabs content-tabs ui-sortable-handle">
                                	<li class="active"><a class="icons_giaithuong" href="#sales-chart" data-toggle="tab">GI?I THU?NG</a></li>
                                    <li><a class="icons_bangvang" href="#revenue-chart" data-toggle="tab">B?NG V�NG</a></li>                                    
                                    <li><a class="icons_binhluan" href="#tab-comment" data-toggle="tab">B�NH LU?N</a></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                        <?php foreach($resultR->LuckyDrawHistoryModel as $history) { ?>
                                            <strong><?php echo $history->UserName; ?> (<?php echo $history->PhoneNumber1; ?>)</strong> d� du?c <strong>1 ch? v�ng SJC</strong> - 22 gi? tru?c<br />
                                        <?php } ?>
                                    </div>
                                    <div class="chart tab-pane active" id="sales-chart" style="position: relative;">
                                    <!-- GIAI THUONG -->
                                        <div class="table-responsive custom-table-responsive"> 
                                            <table class="table table-striped table-sp">
                                                <thead>
                                                    <tr>
                                                        <th>S?n ph?m</th>
                                                        <th>S? lu?ng</th>
                                                        <th>Lo?i</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php foreach($itemR->LuckyDrawItemModel as $item) { ?>
                                                <tr style="background-color:#F7FFE0;">
                                                    <td><img src="http://adsmanage.trathuong.com/Userfiles/LuckyDraw/ItemIcon/<?php echo $item->Icon; ?>" style="width:50px;height:50px;"></td>
                                                    <td><?php echo $item->Quantity; ?></td>
                                                    <td><?php echo $item->ItemName; ?></td>
                                                </tr>
                                              <?php } ?>     
                                                </tbody>
                                        	</table>
                                    	</div>
									<!--END GIAI THUONG -->
                                    </div>
                                    <div class="chart tab-pane" id="tab-comment" style="">
                                        <!-- COMMENT -->
                                        <div class="col-md-12" style="padding:0 5px;">
                                            <div class="well custom-well">
                                                <h4>B?n ngh? g� v? ch�ng t�i?</h4>
                                            <div class="input-group">
                                                <input type="text" id="userComment" class="form-control input-sm chat-input custom-form-control1" placeholder="Vi?t c?m ngh? c?a b?n ..." vk_15e1d="subscribed">
                                                <span class="input-group-btn" onclick="addComment()">     
                                                    <a href="#" class="btn btn-link custom-btn-comment"><span class="glyphicon glyphicon-comment"></span> Nh?n x�t</a>
                                                </span>
                                            </div>
                                            <hr data-brackets-id="12673">
                                            <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
                                                <strong class="pull-left primary-font">topazdinh</strong>
                                                <small class="pull-right text-muted">
                                                   <span class="glyphicon glyphicon-time"></span> 7 ph�t tru?c</small>
                                                <br>
                                                <li class="ui-state-default">alo alo </li>
                                                <br>
                                                 <strong class="pull-left primary-font">Taylor</strong>
                                                <small class="pull-right text-muted">
                                                   <span class="glyphicon glyphicon-time"></span> 7 ph�t tru?c</small>
                                                <br>
                                                <li class="ui-state-default">alo alo</li>
                                                
                                            </ul>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
											function addComment(){
											var userComment = document.getElementById("userComment").value;
											document.getElementById("ui-state-default").innerHTML = userComment;
											}
										</script>
                                        <div class="clearfix"></div>
                                        <!-- END COMMENT -->
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
        <input type="hidden" value="Bootstrap/images/table_quay.png" id="spinImagePath" />
        <input type="hidden" value="<?php echo $itemList; ?>" id= "itemNameList" />
        <!-- dong khung -->
        
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn_quay').click();
    });
    var max_spin = 3;
    var lkdit = '401a0f70-cc1d-e511-941c-001c42aaff6e';
    var spinImagePath = $("#spinImagePath").val();
    begin(spinImagePath);
    var itemList = $('#itemNameList').val();
    
    initialVariable(itemList, lkdit);

    $('.spin-now').click(function(){
        if(ValidationForm())
        {
            var username = $('#UserName').val();
            var phoneNumber = $('#PhoneNumber').val();
            var emailAddress = $('#EmailAddress').val();
            $('.custom-close').click();
            startSpin('undefined', lkdit);
            $.ajax({
                type: 'GET',
                url: 'save-infomation.php',
                data: 'UserName=' + username + '&PhoneNumber=' + phoneNumber + '&EmailAddress=' + emailAddress,
                success: function (response) {
                    if (response != "1"){ 
                        alert("B?n kh�ng th? th?c hi?n quay s? v�o l�c n�y");
                    }
                },
                error: function () {
                }
            });
        }
        else
        {
            return false;
        }
    })
    
    function ValidationForm()
    {
        var isValid = true;
        var username = $('#UserName').val();
        var phoneNumber = $('#PhoneNumber').val();
        var emailAddress = $('#EmailAddress').val();
        if(username == '' || username == null)
        {
            $('.UserName_Err').show();
            isValid = false;
        }
        else
        {
            $('.UserName_Err').hide();
        }
        if(phoneNumber == '' || phoneNumber == null)
        {
            $('.PhoneNumber_Err').show();
            isValid = false;
        }
        else
        {
            $('.PhoneNumber_Err').hide();
        }
        if(emailAddress == '' || emailAddress == null)
        {
            $('.EmailAddress_Err').show();
            isValid = false;
        }
        else
        {
            $('.EmailAddress_Err').hide();
        }
        return isValid;
    }
</script>
</html>

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
    
    <?php
        header("X-Frame-Options: SAMEORIGIN");  
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
            $permissions = ['email','user_likes','publish_actions','user_friends']; // optional
            $loginUrl = $helper->getLoginUrl('https://fbappapp.herokuapp.com/login-callback.php', $permissions);
        }
        catch(exception $ex)
        {
            var_dump($ex);
        	echo 111;
        }
    ?>
</head>
<body>
    <?php 
        $itemList = '';
        $itemR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetItemList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
    	foreach($itemR->LuckyDrawItemModel as $item)
    	{
    	   $itemList = $itemList . ',' . $item->ItemName;
    	}
        $resultR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetHistoryList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
    ?>
   
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
                                    <a href="Shared.php" class="btn btn_share">CHIA SẼ</a>
                                </div>                               
                            </div>
                            <!-- /.khong chia-->                                              
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!-- chia lam hai -->
                        <div class="col-xs-12 col-sm-6" id="sideRound">
                            <!-- chia lam ba--> 
                            <div class="quayso">
                            <!-- TRÚNG GI?I -->
                            <div class="trunggiai">                            	
                                <button style="display: none;" class="btn btn-primary show-result" data-toggle="modal" data-target="#modal-2">TRÚNG GIẢI</button>
                                <div id="modal-2" class="modal" tabindex="-1" role="dialog">
                                  <div class="modal-dialog">
                                    <div class="modal-content cus-mo-content">
                                      <div class="modal-header cus-modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>                                        
                                      </div>
                                      <div class="modal-body">
                                        <h2 class="modal-title" style="font-weight:bold;color:#3f4547;">CHÚC MỪNG BẠN</h2>
                                        <span style="font-size:16pt;">Bạn vừa quay được <span style="font-weight:bold;font-size:18pt;color:#b2e21e;" class="data-result-val">  </span></span><br>
                                        <span style="font-size:16pt;">Cảm ơn bạn đã tham gia chương trình.</span><br>
                                        <span style="font-size:16pt;">Giải thưởng sẽ được gửi đến bạn trong thời gian sớm nhất.</span><br>
                                        <span style="font-size:16pt;">BẠN CÒN <span style="font-weight:bold; font-size:50px;color:#ffc600;">10</span> LƯỢT QUAY</span>
                                      </div>                                      
                                      <div class="modal-footer cus-modal-footer">
                                        <button type="button" class="btn btn-link cus-btn" data-dismiss="modal">QUAY TIẾP</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>                                                                 
                            </div> 
                            <!-- END TRÚNG GI?I -->                                                    
                                <div class="bg_left">
                                    <div class="table_quay">
                                        <canvas class="the_canvas img-responsive" id="myDrawingCanvas" width="434" height="434" onclick="PreSpin();" style="cursor:pointer;">
                                            <p class="noCanvasMsg" align="center">Ôi không?.Trình duyệt của bạn không hổ trợ html5<br />Hãy nâng c?p nó.</p>
                                        </canvas>
                                    	<!-- click quay -->
                                        <a href="<?php echo $loginUrl; ?>" target="_self" class="btn btn-link btn_quay"></a>
                                                     
                                          <!-- Modal -->
                                          <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">                                            
                                              <!-- THONG TIN-->
                                              <div class="modal-content custom-modal-content">
                                                <div class="modal-header custom-modal-header">
                                                  <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">NHẬP THÔNG TIN</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" role="form">
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">Tên Bạn</label>
                                                          <div class="col-sm-9">
                                                            <input class="form-control custom-form-control" name="UserName" id="UserName" type="text" placeholder="Tên Bạn">
                                                            <label style="display: none;color:red;" class="UserName_Err">Vui lòng nhập tên của bạn</label>
                                                          </div>
                                                        </div>
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">Ðiện thoại</label>
                                                          <div class="col-sm-9">
                                                            <input class="form-control custom-form-control" name="PhoneNumber" id="PhoneNumber" type="text" placeholder="Ðiện thoại">
                                                            <label style="display: none;color:red;" class="PhoneNumber_Err">Vui lòng nhập SDT của bạn</label>
                                                          </div>
                                                        </div>
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">Email</label>
                                                          <div class="col-sm-9">
                                                            <input class="form-control custom-form-control" id="EmailAddress" name="EmailAddress" type="text" placeholder="Email">
                                                            <label style="display: none;color:red;" class="EmailAddress_Err">Vui lòng nhập email của bạn</label>
                                                          </div>
                                                        </div>
                                                        <div class="form-group custom-form-group">
                                                          <label class="col-sm-3 control-label custom-control-label">Địa chỉ nhận thưởng</label>
                                                          <div class="col-sm-9">
                                                            <textarea class="form-control custom-form-textarea" rows="5" id="Address" name="Address" placeholder="Địa chỉ nhận thưởng"></textarea>
                                                            <label style="display: none;color:red;" class="Address_Err">Vui lòng nhập địa chỉ của bạn</label>
                                                          </div>
                                                        </div>
                                                        <div class="pull-right">          
                                                        <button type="button" class="btn custom-btn spin-now">Quay Thôi</button>
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
                                	<li class="active"><a class="icons_giaithuong" href="#sales-chart" data-toggle="tab">GIẢI THƯỞNG</a></li>
                                    <li><a class="icons_bangvang" href="#revenue-chart" data-toggle="tab">BẢNG VÀNG</a></li>                                    
                                    <li><a class="icons_binhluan" href="#tab-comment" data-toggle="tab">BÌNH LUẬN</a></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                        <?php foreach($resultR->LuckyDrawHistoryModel as $history) { ?>
                                            <strong><?php echo $history->UserName; ?> (<?php echo $history->PhoneNumber1; ?>)</strong> đã được <strong>1 chỉ vàng SJC</strong> - 22 giờ trước<br />
                                        <?php } ?>
                                    </div>
                                    <div class="chart tab-pane active" id="sales-chart" style="position: relative;">
                                    <!-- GIAI THUONG -->
                                        <div class="table-responsive custom-table-responsive"> 
                                            <table class="table table-striped table-sp">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Số lượng</th>
                                                        <th>Loại</th>
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
                                                <h4>Bạn nghỉ gì về chúng tôi?</h4>
                                            <div class="input-group">
                                                <input type="text" id="userComment" class="form-control input-sm chat-input custom-form-control1" placeholder="Viết cảm nghỉ của bạn ..." vk_15e1d="subscribed">
                                                <span class="input-group-btn" onclick="addComment()">     
                                                    <a href="#" class="btn btn-link custom-btn-comment"><span class="glyphicon glyphicon-comment"></span> Nhận xét</a>
                                                </span>
                                            </div>
                                            <hr data-brackets-id="12673">
                                            <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
                                                <strong class="pull-left primary-font">topazdinh</strong>
                                                <small class="pull-right text-muted">
                                                   <span class="glyphicon glyphicon-time"></span> 7 phút trước</small>
                                                <br>
                                                <li class="ui-state-default">alo alo </li>
                                                <br>
                                                 <strong class="pull-left primary-font">Taylor</strong>
                                                <small class="pull-right text-muted">
                                                   <span class="glyphicon glyphicon-time"></span> 7 phút trước</small>
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
    var spinImagePath = $("#spinImagePath").val();
    begin(spinImagePath);
    var lkdit = '401a0f70-cc1d-e511-941c-001c42aaff6e';
    var itemList = $('#itemNameList').val();
    initialVariable(itemList, lkdit);
</script>
</html>

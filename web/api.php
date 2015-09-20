<?php
	$xml = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetItemList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
    var_dump(count($xml->LuckyDrawItemModel));
?>

<div><?php echo $xml->LuckyDrawItemModel->ItemName; ?></div>
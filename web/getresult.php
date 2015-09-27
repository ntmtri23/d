<?php 
    session_start();
    $totalItem = 8;
    $xml = file_get_contents('http://localhost:7749/LuckyDraw/GetItemSpin/?luckyDrawId=401a0f70-cc1d-e511-941c-001c42aaff6e');
	$itemR = json_decode($xml);
    
    $itemRand = 360 / $totalItem;
    $startVal = $itemRand * ($itemR->Order - 1);
    $endVal = $itemRand * $itemR->Order;
    $reponseVal = rand($startVal,$endVal);
    $_SESSION['ItemId'] = $itemR->ID;
    echo $reponseVal;
?>
<?php 
    session_start();
    $userName = (isset($_REQUEST['UserName'])) ? $_REQUEST['UserName'] : "";
    $phoneNumber = (isset($_REQUEST['PhoneNumber'])) ? $_REQUEST['PhoneNumber'] : "";
    $emailAddress = (isset($_REQUEST['EmailAddress'])) ? $_REQUEST['EmailAddress'] : "";
    $address = (isset($_REQUEST['Address'])) ? $_REQUEST['Address'] : "";
    $gender = (isset($_REQUEST['Gender'])) ? $_REQUEST['Gender'] : "";
  
    if($userName != "" && $phoneNumber != "" && $emailAddress != "")
    {
        $luckydrawitemid = isset($_SESSION['ItemId']) ? $_SESSION['ItemId'] : '';
        if($luckydrawitemid != '')
        {
            $itemR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/AddHistory?luckyDrawItemId=' . $luckydrawitemid . '&fullName=' . $userName . '&phoneNumber=' . $phoneNumber . '&emailAddress=' . $emailAddress . '&gender=' . $gender);
            echo ($itemR) ? "1" : "0";
            return;
        }
    }
    else
    {
        echo "0";
    }
?>
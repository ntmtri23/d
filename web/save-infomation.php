<?php 
    $userName = (isset($_REQUEST['UserName'])) ? $_REQUEST['UserName'] : "";
    $phoneNumber = (isset($_REQUEST['PhoneNumber'])) ? $_REQUEST['PhoneNumber'] : "";
    $emailAddress = (isset($_REQUEST['EmailAddress'])) ? $_REQUEST['EmailAddress'] : "";
    $address = (isset($_REQUEST['Address'])) ? $_REQUEST['Address'] : "";
    $gender = (isset($_REQUEST['Gender'])) ? $_REQUEST['Gender'] : "";
    if($userName != "" && $phoneNumber != "" && $emailAddress != "")
    {
        $itemR = simplexml_load_file('http://fbapp.trathuong.com/ActionService.asmx/GetItemList?luckydrawId=401a0f70-cc1d-e511-941c-001c42aaff6e&fullName=' . $userName . '&phoneNumber=' . $phoneNumber . '&emailAddress=' . $emailAddress . '&gender=' . $gender);
        if($itemR)
            echo "1";
        else
            echo "0";
        return;
    }
    else
    {
        echo "0";
    }
?>
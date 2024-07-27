<?php
session_start();
require_once "./config.php";

// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
// header("Content-type:application/json");

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}


function logmsg($success,$status,$accesstoken,$data,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'accessToken' => $accesstoken,
        'data'  => $data,
        'message' => $message
    ],$extra);
}


$database = new Database();
$conn = $database->getConnection();

//Start of IF Else to Call Action-Function
if($_POST["action"]=="manualPayment"):
    $resp = manualPayment($database, $conn);
    echo json_encode($resp);
else:
    $resp = login($database, $conn);
	echo json_encode($resp);
endif;


function manualPayment($database, $conn ){

    $username = $_POST["name"];
    $amount = $_POST["amount"];
    $pdate = $_POST["pdate"];
    $totamount = 0;

    // CHECKING EMPTY FIELDS
    if(!isset($username) 
        || !isset($amount) 
        || !isset($pdate)
        || empty(trim($username))
        || empty(trim($amount))
        || empty(trim($pdate))
        ):

        $fields = ['fields' => ['name','amount','pdate']];
        $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);
        return $returnData;

    // IF THERE ARE NO EMPTY FIELDS THEN-
    else:
        
        $result1 = array();
        $param1 = array();
        $sql1 = "Select payment_tot_amount from payment where payment_id = ( Select max(payment_id) from payment where member_id = :member_id)"  ;
        $param1["member_id"] =  $_SESSION['userid'];
        $result1 = $database->selectParamQuery($conn, $sql1, $param1);

        if(count($result1) > 0){
            $totamount = $result1[0]['payment_tot_amount'] + $amount;
        }
        else{
            $totamount = $amount;
        }
       
        $result_ = array();
        $param_ = array();
        $sql_ = "INSERT INTO payment
                     (member_id, payment_amount,payment_type,payment_tot_amount,payment_date,payment_source,payment_to,payment_status)
                  VALUES (:mId , :pAmt         , 'C'        , :pTotAmnt        , :pDate     , 'MANUAL'     ,:pName    ,'Pending')";
        $param_["mId"] = $_SESSION['userid'];
        $param_["pAmt"] = $amount;
        $param_["pTotAmnt"] = $totamount;
        $param_["pDate"] = $pdate;
        $param_["pName"] = $username;
        $result_ = $database->insertQuery($conn, $sql_, $param_);
        // print_r($result_);
        // header("Location: http://localhost/Ashara1450/html/payment.php");
        echo "<script> location.href='https://ashara1450.vercel.app/payment.php'; </script>";
        exit;
        return $returnData;
        
        endif;
}

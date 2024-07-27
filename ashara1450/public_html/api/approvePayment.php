<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();


$approvePayment = approve_payment($database, $conn);

function approve_payment($database, $conn){
    
    if (!isset($_POST['payment_id'])){
         echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
         exit;
        return;
    }
    $result = array();
    $sql = " UPDATE payment SET payment_status = 'Approved',updated_by=:member_name Where payment_id = :payment_id "  ;
    $param["payment_id"] = (int)(str_replace("/","",$_POST['payment_id']));
    $param["member_name"] = (int)(str_replace("/","",$_POST['username']));
    $result = $database->updateQuery($conn, $sql,$param);
    
    $result1 = array();
     $sql1 = " UPDATE pending_payments SET pending_amount = pending_amount - :payment_amount Where member_id = :member_id "  ;
     $param1["payment_amount"] = (int)(str_replace("/","",$_POST['payment_amount']));
     $param1["member_id"] = (int)(str_replace("/","",$_POST['username']));
     $result1 = $database->updateQuery($conn, $sql1,$param1); 
     print_r($result1);
     if($result1 != "success" ){
         return;
     };
     
    if($result = "success" ){
        //  print_r($result);
        // header("Location: http://localhost/Ashara1450/html/authpayment.php");
         echo "<script> location.href='https://ashara1450.vercel.app/authpayment.php'; </script>";
        exit;
    }else {
        print_r($result);
    };
}
 

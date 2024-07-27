<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();


$rejectPayment = reject_payment($database, $conn);

function reject_payment($database, $conn){

        if (!isset($_POST['payment_id'])){
        echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
        exit;
        return;
    }
    $result = array();
    $sql = " UPDATE payment SET payment_status = 'Reject',updated_by=:member_name,payment_tot_amount = payment_tot_amount - :payment_amount WHERE payment_id = :payment_id "  ;
    $param["payment_id"] = (int)(str_replace("/","",$_POST['payment_id']));
    $param["member_name"] = (int)(str_replace("/","",$_POST['username']));
    $param["payment_amount"] = (int)(str_replace("/","",$_POST['payment_amount']));
    $result = $database->updateQuery($conn, $sql,$param); 
    if($result = "success" ){
        //   print_r($result);
        // header("Location: http://localhost/Ashara1450/html/authpayment.php");
        echo "<script> location.href='https://ashara1450.vercel.app/authpayment.php'; </script>";
        exit;
    }else {
        print_r($result);
    };
}
 

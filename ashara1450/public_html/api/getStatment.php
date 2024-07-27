<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();


$fetchPayment = fetch_payment($database, $conn);

function fetch_payment($database, $conn){

    // if (!isset($_SESSION['userid'])){
    //     // header("Location: https://ashara1450.vercel.app/index.php");
    //     echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
    //     exit;
    // }

    // if (strcmp(strval($_SESSION['userid']),strval(str_replace("/","",$_POST['member_id']))) !== 0){
    //     // header("Location: https://ashara1450.vercel.app/index.php");
    //     echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
    //     exit;
    // }


    $result = array();
    $sql = " SELECT payment_id,payment_amount,payment_type,payment_date,payment_tot_amount,payment_source,payment_status FROM payment Where member_id = :memberid Order by payment_id desc"  ;
    $param["memberid"] = (int)(str_replace("/","",$_POST['member_id']));
    $result = $database->selectParamQuery($conn, $sql,$param); 
    // print_r($result);
    if(count($result) > 0):
        return $result;
    endif;
}
 

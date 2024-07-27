<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();

    $result1 = array();
    $sql1 = " SELECT pending_amount,pending_date FROM pending_payments"  ;
    $result1 = $database->selectQuery($conn, $sql1); 
    if(count($result1) > 0){
        for ($i = 0; $i <= count($result1)  ; $i ++ ){
            $month=date("F",strtotime($result1[0]["pending_date"]));
            print_r($month);
            print_r(date("F"));
            print_r(date("Y-m-d H:i:s"));
            $timezone = date_default_timezone_get();
            echo "The current server timezone is: " . $timezone;
            if ($month == date("F")){
                print_r("Error: Pending amount already added for the Month");
                return;
            };
        }
    };

    $result = array();
    $sql = " UPDATE pending_payments SET pending_amount =pending_amount + 1000, pending_date = :date1"  ;
    $param["date1"] = date("Y-m-d"); 
    $result = $database->updateQuery($conn, $sql,$param); 
    if($result = "success" ){
        echo "<script> location.href='https://ashara1450.vercel.app/authpayment.php'; </script>";
        exit;
    }else {
        print_r($result);
    };

 

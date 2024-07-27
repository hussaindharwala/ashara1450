<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();

$fetchTot = fetch_tot($database, $conn);

function fetch_tot($database, $conn){
    $result = array();
    $sql = "  Select sum(payment_tot_amount) tot_amt from `payment` Where payment_id IN ( SELECT max(payment_id) FROM `payment` where payment_status = 'Approved' group by member_id)"  ;
    $result = $database->selectQuery($conn, $sql); 
    if(count($result) > 0):
        // print_r($result);
        return $result;
    endif;
}
 



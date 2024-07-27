<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();

$fetchPending = fetch_pending($database, $conn);
$fetchOverdue = fetch_overdue($database, $conn);

function fetch_pending($database, $conn){
    $result = array();
    $sql = " SELECT a.payment_id,b.member_id,b.member_name,a.payment_source,a.payment_amount,a.payment_date FROM payment a,member b WHERE a.member_id = b.member_id AND  a.payment_status = 'Pending'"  ;
    $result = $database->selectQuery($conn, $sql); 
    if(count($result) > 0):
        return $result;
    endif;
}
 
function fetch_overdue($database, $conn){
    $result = array();
    $sql = " SELECT a.pending_amount,b.member_id,a.pending_date,b.member_name FROM pending_payments a,member b WHERE a.member_id = b.member_id"  ;
    $result = $database->selectQuery($conn, $sql); 
    if(count($result) > 0):
        return $result;
    endif;
}
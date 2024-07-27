<?php
session_start();
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();

$fetchData = fetch_data($database, $conn);

function fetch_data($database, $conn){
    $result = array();
    $sql =" SELECT b.member_id,member_name,member_occupation,member_address,member_avatar,a.pending_amount FROM member b,pending_payments a WHERE member_active = 1 AND a.member_id = b.member_id"  ;  ;
    $result = $database->selectQuery($conn, $sql); 
    if(count($result) > 0):
        // print_r($result);
        return $result;
    endif;
}
 

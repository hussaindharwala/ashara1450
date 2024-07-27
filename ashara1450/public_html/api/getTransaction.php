<?php 
header('Content-Type:text/csv');
header('Content-Disposition:attachment;filename="statement.csv"');
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();

$result = $param = array();

$sql = "SELECT member_name, payment_amount,payment_date,payment_status,c.pending_amount FROM payment a,member b,pending_payments c WHERE a.member_id = b.member_id AND b.member_id = c.member_id AND b.member_id = :member_id Order by a.payment_id"  ;
    $param["member_id"] = (int)(str_replace("/","",$_POST['member_id']));
    $result = $database->selectParamQuery($conn, $sql , $param); 

if(count($result) > 0):
    $fp = fopen('php://output', 'wb');
    $data1 = array(
            ',Member Name,Amount Paid,Payment Date, Payment Status,Pending Amount',
        );
    foreach ( $data1 as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }

    for ($i = 0; $i < count($result) ; $i++){
        $data = array(
        ",".$result[$i]['member_name']."," .$result[$i]["payment_amount"]."," .$result[$i]["payment_status"].",".$result[$i]["payment_date"].",".$result[$i]["pending_amount"],
     );
     foreach ( $data as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }
    }
endif;
fclose($fp);
?>
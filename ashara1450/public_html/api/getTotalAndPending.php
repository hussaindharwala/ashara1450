<?php 
header('Content-Type:text/csv');
header('Content-Disposition:attachment;filename="transaction.csv"');
require_once "config.php";
$database = new Database();
$conn = $database->getConnection();

$result = array();
$sql = "     SELECT b.member_name ,a.payment_tot_amount,a.payment_date,c.pending_amount FROM
    member b  
    LEFT JOIN payment  a
    ON b.member_id = a.member_id AND a.payment_id IN (select max(d.payment_id) from payment d Group By d.member_id),pending_payments c WHERE c.member_id = b.member_id Order by b.member_id"  ;
$result = $database->selectQuery($conn, $sql); 

if(count($result) > 0):
    $fp = fopen('php://output', 'wb');
    $data1 = array(
            ',Member Name,Total Amount Paid,Payment Date, Pending Amount',
        );
    foreach ( $data1 as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }

    for ($i = 0; $i < count($result) ; $i++){
        $data = array(
        ",".$result[$i]['member_name']."," .$result[$i]["payment_tot_amount"].",".$result[$i]["payment_date"].",".$result[$i]["pending_amount"],
     );
     foreach ( $data as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }
    }
endif;
fclose($fp);
?>
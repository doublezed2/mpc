<?php
    date_default_timezone_set("Asia/Karachi");
    $from_date = date("Y-m-d")." 00:00:00"; 
    $to_date = date("Y-m-d h:i:s"); 
    $qsql = "SELECT * FROM sales WHERE date_created >= '$from_date' AND date_created < '$to_date'";
    $qresult = $conn->query($qsql);  
    echo $qresult->num_rows + 1;
            
?>
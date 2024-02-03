<?php
$date = date_create("05-12-2021");

date_add($date, date_interval_create_from_date_string("40 days"));

echo date_format($date, "d-m-Y");
 
?>
<?php
$time = "20:03:20";
$time2 = "10:03:20";
echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
echo "hello ". date ( "U", strtotime ( $time ) )."<br>";
echo "hello ". date ( "U", strtotime ( $time2 ) )."<br>";

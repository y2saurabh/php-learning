<?php
function dbconnect() {
global $connect;
$connect = mysqli_connect('localhost', 'saurabh', 'saurabh123#1', 'testdb') or die();
return $connect;
}

?>

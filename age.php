<?php
//$dob = birthdate in the form "YYYY-MM-DD"
//Extract the month, day and year from the $dob
//Compare to current month, day, year to get AGE

$birthyear = 1985;
$birthmonth = 06;
$birthdate = 14;
$birtharray = array ("$birthyear","$birthmonth","$birthdate");
$birtharrayimp = implode('-',$birtharray);


$currentyear = date("Y");
$currentmonth = date("m");
$currentdate = date ("d");
$currentarray = array ("$currentyear","$currentmonth","$currentdate");
$currentarrayimp = implode('-',$currentarray);

$date1=date_create($currentarrayimp);
$date2=date_create($birtharrayimp);
$diff= date_diff($date1,$date2);

echo $diff->format('%y Years, %m Months and %d Days');
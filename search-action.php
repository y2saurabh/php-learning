<?php
//Connect to Database
require_once ('db-connect.php');
dbconnect();
global $connect;

//Get Search Value
$search = $_GET['search'];

$searchquery = "SELECT userid, firstname, lastname, salutation, profession FROM userinfo WHERE firstname LIKE '$search' OR lastname LIKE '$search'";
$searchresult = mysqli_query ($connect, $searchquery);
while($row = mysqli_fetch_array($searchresult)){
	$searchid = $row['userid'];
	$searchfirstname = $row['firstname'];
	$searchlastname = $row['lastname'];
	$searchsalutation = $row['salutation'];
	$searchprofession = $row['profession'];
?>
<table width="500px;">
<tr>
<td><?php echo $searchid ?></td>
<td><?php echo $searchfirstname ?></td>
<td><?php echo $searchlastname ?></td>
<td><?php echo $searchsalutation ?></td>
<td><?php echo $searchprofession ?></td>
</tr>
</table>
<?php
}

if (mysqli_num_rows($searchresult) == 0) {
	echo 'No Results Found';
}
?>
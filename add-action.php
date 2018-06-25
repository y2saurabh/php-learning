<?php
//connection file
require_once ('db-connect.php');
// get values from form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$salutation = $_POST['salutation'];
if (isset($_POST['profession'])) {
   $profession = implode(",",$_POST['profession']);
}
else {
  $profession = '';
}
$birthyear = $_POST['birthyear'];
$birthmonth = $_POST['birthmonth'];
$birthdate = $_POST['birthdate'];
//connect to database

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
$datediffrencestring = $diff->format('%y Years, %m Months and %d Days');
dbconnect();
global $connect;
$firstnamequery = "SELECT firstname FROM userinfo WHERE firstname = '$firstname'";
$lastnamequery = "SELECT lastname FROM userinfo WHERE lastname = '$lastname'";
$firstnamecheck = mysqli_query($connect, $firstnamequery);
$lastnamecheck = mysqli_query($connect, $lastnamequery);
if (mysqli_num_rows($firstnamecheck) > 0 && mysqli_num_rows($lastnamecheck) > 0 ) {
	echo "Name Already Exist.";
}
else {
$insertquery = "INSERT INTO userinfo ( firstname, lastname, salutation, profession, userage) VALUES ('$firstname', '$lastname', '$salutation', '$profession', '$datediffrencestring')";
$insertuserinfo = mysqli_query($connect, $insertquery);
if ($insertuserinfo) {
	echo "New record created successfully";
}
}
$readquery = "SELECT userid, firstname, lastname, salutation, profession, userage FROM userinfo";
$readuserinfo = mysqli_query ($connect, $readquery);
?>
     <table width="600px">
     <thead>
    <tr> <th>ID</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Salutaion</th>
     <th>Profession</th>
     <th>AGE</th>
     <th>Edit</th>
     </tr>
     </thead>
 	     <tbody>
<?php
while($row = mysqli_fetch_array($readuserinfo)){
$displayid = $row['userid'];
$displayfirstname = $row['firstname'];
$displaylastname = $row['lastname'];
$displaysalutation = $row['salutation'];
$displayprofession = $row['profession'];
$displayage = $row['userage'];
 ?>
<tr>
     <td><?php echo $displayid ?></td>
     <td><?php echo $displayfirstname ?></td>
     <td><?php echo $displaylastname ?></td>
  <td><?php echo $displaysalutation ?></td>
  <td><?php echo $displayprofession ?></td>
  <td><?php echo $displayage ?></td>
  <td><a href="edit.php?id=<?php echo $displayid?>">Edit</a></td>
    <tr> 
     
     <?php }
	 mysqli_close($connect);
	 ?>
	 
     </tbody>
     </table>
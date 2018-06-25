<?php
if(isset($_GET['id'])) {
 $id = $_GET['id'];
//connection file
require_once ('db-connect.php');
dbconnect();
 global $connect;

// get values from form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$salutation = $_POST['salutation'];
$profession = implode(",",$_POST['profession']);
//connect to database

dbconnect();
global $connect;
$updatequery = "UPDATE userinfo SET firstname='$firstname', lastname='$lastname', salutation='$salutation', profession='$profession' WHERE userid = '$id'";
$updateuserinfo = mysqli_query($connect, $updatequery);
if ($updateuserinfo) {
	echo "Record Updated Successfully. Here is your new info";
};
$readquery = "SELECT userid, firstname, lastname, salutation, profession FROM userinfo WHERE userid = '$id'";
$readuserinfo = mysqli_query ($connect, $readquery);
?>
     <table width="600px">
     <thead>
    <tr> <th>ID</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Salutaion</th>
     <th>Profession</th>
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
 ?>
<tr>
     <td><?php echo $displayid ?></td>
     <td><?php echo $displayfirstname ?></td>
     <td><?php echo $displaylastname ?></td>
  <td><?php echo $displaysalutation ?></td>
  <td><?php echo $displayprofession ?></td>
  <td><a href="edit.php?id=<?php echo $displayid?>">Edit</a></td>
    <tr> 
     
     <?php } }
	 mysqli_close($connect);
	 ?>
	
     </tbody>
     </table>
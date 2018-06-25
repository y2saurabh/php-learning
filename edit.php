<?php 
require_once ('db-connect.php');
if(isset($_GET['id'])) {
 $id = $_GET['id'];
 dbconnect();
 global $connect;
 $readquery = "SELECT firstname, lastname, salutation, profession FROM userinfo WHERE userid = '$id'";
 $result = mysqli_query($connect, $readquery);
 if(mysqli_num_rows($result)==1){
 $row = mysqli_fetch_array($result);
 if($row){
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $salutation = $row['salutation'];
$profession = explode(',', $row['profession']);
?>
<form method="post" action="update.php?id=<?php echo $id?>">
<table width="500">
<tr><td>Firstname</td><td><input name="firstname" type="text" value="<?php echo $firstname ?>" /></td></tr>
<tr><td>Lastname</td><td><input type="text" value="<?php echo $lastname ?>" name="lastname"/></td></tr>
<tr><td>Salutation</td><td>
<select name="salutation">
<option value="mr" <?php if($row['salutation'] == 'mr'){echo 'Selected';} ?>>Mr</option>
<option value="miss" <?php if($row['salutation'] == 'miss'){echo 'Selected';} ?>>Miss</option>
<option value="mrs" <?php if($row['salutation'] == 'mrs'){echo 'Selected';} ?>>Mrs</option>
</select>
</td></tr>
<tr><td>Profession</td><td><input name="profession[]" type="checkbox" value="designer" <?php if(in_array('designer',$profession)){echo 'Checked';} ?>>Designer <input name="profession[]" type="checkbox" value="developer" <?php if(in_array('developer',$profession)){echo 'Checked';} ?>>Developer <input name="profession[]" type="checkbox" value="advocate" <?php if(in_array('advocate',$profession)){echo 'Checked';} ?>>Advocate</td></tr>
<tr><td></td><td><input type="submit" value="submit" name="submit"></td></tr>
</table></form>
 <?php
  } 
  }
}
?>
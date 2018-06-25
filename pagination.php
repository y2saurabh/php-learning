<?php
//connect to db
require_once ('db-connect.php');
dbconnect();
global $connect;
$paginationlimit = 2;
if (isset($_GET["page"])) { 
$page  = $_GET["page"]; 
} 
else { 
$page=1; 
};  
$start_from = ($page-1) * $paginationlimit;  
$readquery = "SELECT userid, firstname, lastname, salutation, profession, userage FROM userinfo LIMIT $start_from, $paginationlimit";
$readuserinfo = mysqli_query ($connect, $readquery);
?>
<table width="100%" border="1">
<?php 
while ($row = mysqli_fetch_array($readuserinfo)) {
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
</tr>
<?php  
};  
?> 
</table>
<?php
$pagination = "SELECT COUNT(userid) FROM userinfo";
$paginationquery = mysqli_query ($connect, $pagination);
$paginationrows = mysqli_fetch_row($paginationquery);
$totalrecords = $paginationrows[0];
$totalpages = ceil($totalrecords / $paginationlimit);

echo "<a href='pagination.php?page=1'>First</a>&nbsp;";
for ($i=1; $i<=$totalpages; $i++) {  
      echo "<a href='pagination.php?page=".$i."'>".$i."</a>&nbsp;";  
}; 
 echo "<a href='pagination.php?page=".$totalpages."'>Last</a>"; 
  mysqli_close($connect); 
?>

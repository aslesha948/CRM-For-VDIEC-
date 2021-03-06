<?php
//must appear BEFORE the <html> tag
session_start();
include('config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Management</title>
  <?php include("include/header.inc") ?>
</head>
<body onLoad="run_first()">
<?php include("include/banner.inc") ?>
<?php include("include/nav.inc") ?>

<!--To check whether the user is logged in -->
<?php 
if(isset($_SESSION['valid_user']))
{
  $email=$_SESSION['valid_user'];


  $conn  = db_connect();

  // //make a query to check if a valid user
  $role_sql = "select role from users where email='$email'";

  $result_role = $conn -> query($role_sql);


  if ($result_role -> num_rows == 1) {
           $row = $result_role -> fetch_assoc();
           $role = $row['role'];

          if($role == "admin" || $role == "manager"){

          //  echo "This is working";
  
  //$role = "manager";

 //  if ($result_role== "admin") {
 //    echo "You are on the right track";
 //  }
 // else {echo "check again";}

  
?>
<div class="container">

<div class="row">
  <div class="col">
<?php if(isset($_GET['suc']))
{?>
  <div class="alert alert-success">
  <strong>Success!</strong> User added succesfully
</div>
<?php } 

 if(isset($_GET['err']))
{?>
  <div class="alert alert-warning">
  <strong>Error!</strong> Please try again
</div>
<?php } 
  ?>


<h1>Admin Management</h1>
<p><a href="Add-User.php" class="button-red"> Add a new User </a></p> 

<p><a href="Add-Student.php" class="button-red"> Create Student Login </a></p>

</div>
</div>

<div class="row">
  <div class="col">

<p>The existing users are : </p>


<?php
$con=db_connect();
$sql="SELECT * FROM users";

$result = mysqli_query($con,$sql);

echo "<table border='2'style='width:100%'>
<tr>
<th>Employee ID </th>
<th>Name</th>
<th>Email</th>
<th>Password</th>
<th>Number</th>
<th>Address</th>
<th>Action </th>
</tr>";

while($row = mysqli_fetch_array($result))
{
$uid = $row['id'];
echo "<tr>";
echo "<td>" . $uid . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo "<td>" . $row['number'] . "</td>";
echo "<td>" . $row['Address'] . "</td>";
echo "<td><button type=\"button\" class=\"btn btn-warning\" style=\"float:right\" ><a href=\"updateUser.php?user=".$uid."\">Edit</a></button></td>";
echo "</tr>";

}

if(isset($_GET['user']))
    {
      $user=$_GET['user'];

      $sel=mysqli_query($con,"select * from users where id='$user'");
    }

echo "</table>";

mysqli_close($con);
?>
  
</div>
</div>

</div>
<!--Else it redirects to login page -->
<?php }
else{

?><div class="container">

<div class="row">
  <div class="col">
<?php 
  echo "You do not have access to this page";
?>

</div>
</div>
</div>
<?php 

}
}
}
else
{
  header("location:index.php");
}
?>

      
  <?php include("include/footer.inc") ?>
</body>
</html>



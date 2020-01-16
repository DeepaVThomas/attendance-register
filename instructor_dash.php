<?php
$t_email = $_POST['t_email'];
$t_password = $_POST['t_password'];
$con = mysqli_connect("localhost","root","Appu196!","residency");
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 5 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 300) {
    // session started more than 5 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
//session.gc_maxlifetime = 300;
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$t_email = mysqli_real_escape_string($con, $_POST['t_email']);
$t_password = mysqli_real_escape_string($con, $_POST['t_password']);
$t_email = stripcslashes($t_email);
$t_password = stripcslashes($t_password);

$sql = "SELECT * FROM teacher WHERE t_email = '$t_email' AND t_password = '$t_password';";
$result=mysqli_query($con,$sql);
if (!$result)
  {
  echo "Failed query ";
  }
else{
$row = mysqli_fetch_array($result);
if ($row['t_email'] == $t_email && $row['t_password'] == $t_password){
echo "Welcome ".$row['firstName'];
$a= $row['teacherID'];
$_SESSION['tID']=$a;
//echo "<br>$_SESSION['teacherID']";
echo "<br><a href='attend_register.php'>Attendance Register</a><br>";
echo "<br><a href='instructor_logout.php'><input type=button value=logout name=LOGOUT></a>";
}
else{
echo "<script>alert('username or password incorrect!')</script>";
echo"<script>location.href='instructor_login.html'</script>";
}
}
?>	
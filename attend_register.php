<html>
<h1>SELECT SUBJECT</h1>
</html>
<?php
session_start();
$Tid = $_SESSION['tID'];
$con = mysqli_connect("localhost","root","Appu196!","residency");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//get all selections
$query="SELECT courseName FROM course";
$result=mysqli_query($con,$query);
/*while($course=mysqli_fetch_array($result)){
	$courseID=$course[0];
	$course_arr[$courseID]=$courseID;
}*/
echo "<select name='sub1'>";
while($row=mysqli_fetch_array($result)){
	echo "<option value='" . $row['courseName'] ."'>" . $row['courseName'] ."</option>";
	
	/*$key=$course[0];
	if ($key==$course_arr[$key]){
		$select_str .="<OPTION VALUE=\"$key\"SELECTED>$course[1]\n";
	}
	else{
		$select_str .="<OPTION VALUE=\"$key\">$course[1]\n";
	}*/
}
echo "</select>";

mysqli_close($con);
?>
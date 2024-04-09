<form method="post">
	Student ID : <input type="text" name="student_id" placeholder="Vul in: Student ID"><br><br>
	Naam : <input type="text" name="name" placeholder="Vul in: Naam"><br><br>
	Bijbaan : <input type="text" name="side_job" placeholder="Vul in: Bijbaan"><br><br>
	Bedrijf : <input type="text" name="company" placeholder="Vul in: Bedrijf"><br><br>
	Uren per week : <input type="text" name="hours_per_week" placeholder="Vul in: Uren per week"><br><br>
	<input type="submit" name="add" value="Voeg toe">
	<input type="reset" name="reset" value="Afbreken">
  <input type="button" value="Terug" onclick="location.href='index.php';">
</form>
<?php
if(isset($_POST['add']))
{
include 'config/db_config.php';
  $student_id=$_POST['student_id'];
  $name=$_POST['name'];
  $side_job=$_POST['side_job'];
  $company=$_POST['company'];
  $hours_per_week=$_POST['hours_per_week'];
 
  $sql="INSERT INTO students (student_id,name,side_job,company,hours_per_week) VALUES ('$student_id','$name','$side_job','$company','$hours_per_week')";
  if($conn->query($sql) === false)
  { 
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }  
  else 
  { 
    echo "<script>alert('Toevoeging Successvol!')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=index.php\">";
  }
}

?>   
<?php
include 'config/db_config.php';
$a=mysqli_query($conn,"SELECT * FROM students WHERE student_id='$_GET[student_id]'");
$b=mysqli_fetch_array($a,MYSQLI_ASSOC)
?>
<form method="post">
	Student ID : <input type="text" name="student_id" placeholder="Insert Student ID" value="<?= $b['student_id'] ?>"><br><br>
	Name : <input type="text" name="name" placeholder="Vul in: Name" value="<?= $b['name']; ?>"><br><br>
	Bijbaan : <input type="text" name="side_job" placeholder="Vul in: Bijbaan" value="<?= $b['side_job']; ?>"><br><br>
	Bedrijf : <input type="text" name="company" placeholder="Vul in: Bedrijf" value="<?= $b['company']; ?>"><br><br>
  Uren per week : <input type="text" name="hours_per_week" placeholder="Vul in: Uren per week" value="<?= $b['hours_per_week']; ?>"><br><br>
	<input type="submit" name="update" value="Update">
	<input type="reset" name="cancel" value="Afbreken">
  <input type="button" value="Terug" onclick="location.href='index.php';">
</form>
<?php
if(isset($_POST['update']))
{
  include 'config/db_config.php';
  $student_id=$_POST['student_id'];
  $name=$_POST['name'];
  $side_job=$_POST['side_job'];
  $company=$_POST['company'];
  $hours_per_week=$_POST['hours_per_week'];

  $sql="UPDATE students SET student_id='$student_id',name='$name',side_job='$side_job',company='$company',hours_per_week='$hours_per_week' WHERE student_id='$_GET[student_id]'";
  if($conn->query($sql) === false)
  {
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }  
  else 
  { 
    echo "<script>alert('Update Successvol!')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=index.php\">";
  }
}

?>   
<html>

<head>
  <meta charset="UTF-8">
  <title>Side Job Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font: 14px sans-serif;
      text-align: center;
    }

    .wrapper {
      width: 720px;
      padding: 20px;
      margin: auto;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <h1 class="my-5">Bijbaan Registratie</h1>

    <a href="add.php" class="btn btn-info">Voeg registratie toe</a>
    <br><br>
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <th>Student ID</th>
          <th>Naam</th>
          <th>Bijbaan</th>
          <th>Bedrijf</th>
          <th>Uren per week</th>
          <th>Opties</th>
        </tr>
        <?php
        ini_set('display_errors', 'On');
        error_reporting(E_ALL);

        include 'config/db_config.php';
        $a = $conn->query("SELECT * FROM students");
        // var_dump($a->fetch_assoc());
        while ($b = $a->fetch_assoc()) {
          // var_dump($b);
        ?>
          <tr>
            <td><?= $b['student_id']; ?></td>
            <td><?= $b['name']; ?></td>
            <td><?= $b['side_job']; ?></td>
            <td><?= $b['company']; ?></td>
            <td><?= $b['hours_per_week']; ?></td>
            <td>
              <a href="update.php?student_id=<?= $b['student_id']; ?>"><b><i>Edit</i></b></a> |
              <a href="index.php?student_id=<?= $b['student_id']; ?>" onclick="return confirm('Are you sure?')"><b><i>Delete</i></b></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <br><br>
    <a href="contact/helpdesk.php" class="btn btn-secondary">Verstuur een vraag naar de helpdesk</a>
  </div>
</body>

</html>

<?php
if (isset($_GET['student_id'])) {
  $student_id = $_GET['student_id'];
  $sql = "DELETE FROM students WHERE student_id='$student_id'";
  if ($conn->query($sql) === false) {
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  } else {
    echo "<script>alert('Delete Successvol!')</script>";
    echo "<meta http-equiv=refresh content=\"0; url=index.php\">";
  }
}

?>
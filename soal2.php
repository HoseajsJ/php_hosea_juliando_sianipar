<?php 

$step = isset($_POST['step']) ? $_POST['step'] : 1;

if ($step == 2 && isset($_POST['nama'])) {
  $_SESSION['nama'] = $_POST['nama'];
}elseif ($step == 3 && isset($_POST['umur'])) {
  $_SESSION['umur'] = $_POST['umur'];
}elseif ($step == 4 && isset($_POST['hobi'])) {
  $_SESSION['hobi'] = $_POST['hobi'];
}

if (isset($_GET['reset'])) {
  session_destroy();
  header("location: soal2.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Soal 2 - Wizard</title>
    <style>
        .box { border: 1px solid black; padding: 20px; width: 300px; margin: 20px; }
        input[type="text"] { margin-bottom: 10px; }
    </style>
</head>
<body>


<?php
switch ($step) {
  case 1:
      ?>
      <div class="box">
            <form method="post">
                <label>Nama Anda :</label><br>
                <input type="text" name="nama" required><br>
                <input type="hidden" name="step" value="2">
                <input type="submit" value="SUBMIT">
            </form>
        </div>
        <?php
    break;
  
  case 2:
      ?>
      <div class="box">
        <form method="post">
                <label>Umur Anda :</label><br>
                <input type="number" name="umur" required><br>
                <input type="hidden" name="step" value="3">
                <input type="submit" value="SUBMIT">
            </form>
        </div>
        <?php
        break;

  case 3:
      ?>
      <div class="box">
            <form method="post">
                <label>Hobi Anda :</label><br>
                <input type="text" name="hobi" required><br>
                <input type="hidden" name="step" value="4">
                <input type="submit" value="SUBMIT">
            </form>
        </div>
        <?php
        break;

  case 4:
    ?>
        <div class="box">
            <p><strong>Hasil Data:</strong></p>
            Nama: <?php echo htmlspecialchars($_SESSION['nama']); ?><br>
            Umur: <?php echo htmlspecialchars($_SESSION['umur']); ?><br>
            Hobi: <?php echo htmlspecialchars($_SESSION['hobi']); ?><br>
            <br>
            <a href="?reset=1">Ulangi</a>
        </div>
        <?php
    break;
}

?>


</body>
</html>

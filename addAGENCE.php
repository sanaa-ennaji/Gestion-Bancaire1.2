<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $longitude = isset($_POST["longitude"]) ? $_POST["longitude"] : "";
    $latitude = isset($_POST["latitude"]) ? $_POST["latitude"] : "";
    $adresse = isset($_POST["adresse"]) ? $_POST["adresse"] : "";
    $bank_id = isset($_POST["bank_id"]) ? $_POST["bank_id"] : "";

    // Insert agency
    $sql = "INSERT INTO agencies (longitude, latitude, adresse, bank_id) VALUES ('$longitude', '$latitude', '$adresse', '$bank_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Agency added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Add Bank</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Central banking</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="bank.php"><i data-feather="corner-down-left"></i> Back to Banks</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-5">
<div class="d-flex p-5 justify-content-between">
   <h1> add agence</h1>
</div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="longitude">Longitude:</label>
            <input type="text" class="form-control" name="longitude" required>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude:</label>
            <input type="text" class="form-control" name="latitude" required>
        </div>
        <div class="form-group">
            <label for="adresse">Address:</label>
            <input type="text" class="form-control" name="adresse" required>
        </div>
        <div class="form-group">
    <label for="bank_id">bank ID:</label>
    <input type="text" class="form-control" name="bank_id" required>
    </div>

        <button type="submit" class="btn btn-primary">Add Agency</button>
    </form>
    <script>
      feather.replace();
    </script>
</body>
</html>

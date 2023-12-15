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

    $sql = "INSERT INTO  distributeurs  (longitude, latitude, adresse, bank_id) VALUES ('$longitude', '$latitude', '$adresse', '$bank_id')";

    if (mysqli_query($conn, $sql)) {
        echo "";
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
    <style>
      
      body{
        background-color:#0066CC;
       }
    </style>
</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="distrubition.php">
                <i data-feather="corner-down-left"></i> Back to distributeur
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bank.php">
                <i data-feather="home"></i> Banks
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="agence.php">
                <i data-feather="layers"></i> Agences
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="user.php">
                <i data-feather="users"></i> Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adresse.php">
                <i data-feather="map-pin"></i> Addresses
              </a>
            </li>
            <li class="nav-item">
                        <a class="nav-link" href="addRole.php">
                        <i data-feather="users"></i>  Roles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="distrubition.php">
                        <i data-feather="layers"></i> Distributors
                        </a>
                    </li>
             
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                        <i data-feather="log-out"></i> Log Out
                        </a>
                    </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 ">
<div class="container mt-3">
<div class="d-flex p-5 justify-content-between">
   <h1> add distributeurs </h1>
</div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  >
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
    <input type="text" class="form-control " name="bank_id" required>
    </div>

        <button type="submit" class="btn btn-primary mb-4"> add distributeurs </button>
    </form>
    <script>
      feather.replace();
    </script>
</body>
</html>

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
    $name = $_POST["name"];
    $logoTmpName = $_FILES["logo"]["tmp_name"];
    $logoType = $_FILES["logo"]["type"];

    if ($logoType == "image/jpeg" || $logoType == "image/png" || $logoType == "image/gif") {
        $logo = addslashes(file_get_contents($logoTmpName));

        // Insert bank
        $sql = "INSERT INTO banks (name, logo) VALUES ('$name', '$logo')";

        if (mysqli_query($conn, $sql)) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
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
       nav{
        height: 100vh;
       }
    </style>
</head>
<body>
<nav>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="bank.php">
                <i data-feather="corner-down-left"></i> Back to banks
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
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="container mt-5">
          <div class="d-flex p-5 justify-content-between">
            <h1> add bank</h1>
          </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Bank Name:</label>
            <input type="text" class="form-control" name="name" style="width: 600px;" required>
        </div>
        <div class="form-group">
          <label for="logo">Logo:</label>
           <input type="file" class="form-control-file" name="logo" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Bank</button>
        </form>
          <script>
            feather.replace();
          </script>
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";
    $address_id = isset($_POST["address_id"]) ? $_POST["address_id"] : null;
    $agency_id = isset($_POST["agency_id"]) ? $_POST["agency_id"] : null;
    $role_id = isset($_POST["role_id"]) ? $_POST["role_id"] : null;

    $sql = "INSERT INTO users (username, password, confirmPassword, address_id, agency_id, role_id) 
            VALUES ('$username', '$password', '$confirmPassword', $address_id, $agency_id, $role_id)";

    if (mysqli_query($conn, $sql)) {
        echo "User added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
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
              <a class="nav-link active" href="user.php">
                <i data-feather="corner-down-left"></i> Back to Users 
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
        <div class="container mt-2">
<div class="container mt-2">
    <div class="d-flex p-10 justify-content-between">
        <h1> Add User</h1>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmPassword" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address_id">Address ID:</label>
            <input type="text" name="address_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="agency_id">Agency ID:</label>
            <input type="text" name="agency_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="role_id">Role ID:</label>
            <input type="text" name="role_id" class="form-control">
        </div>
        <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
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






























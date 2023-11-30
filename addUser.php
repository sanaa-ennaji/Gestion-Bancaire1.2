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
    <title>Add User</title>
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
        <a class="nav-link" href="#"><i data-feather="corner-down-left"></i> Back to Banks</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-5">
    <div class="d-flex p-5 justify-content-between">
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
</body>
</html>






























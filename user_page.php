<?php
session_start();
if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role_id"]) || $_SESSION["role_id"] != 2) {
    header("Location: log.php");
    exit();
}

$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM users
        LEFT JOIN addresses ON users.address_id = addresses.id
        WHERE users.id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    header("Location: log.php");
    exit();
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
    <title>User Profile</title>
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
                <a class="nav-link" href="logout.php"><i data-feather="log-out"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex p-5 justify-content-between">
        <h1> your account</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome, <?php echo $user_data['username']; ?>!</h5>
            <p class="card-text">adresse: <?php echo $user_data['ville']; ?></p>
          
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] != 'user') {
    header("Location: login.php");
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

var_dump($_SESSION);  
$user = $_SESSION['user'];

var_dump($user);
$userID = $user['id'];

$sql = "SELECT * FROM users WHERE id = $userID";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} elseif (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    var_dump($userData);
} else {
    header("Location: login.php");
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
        <h1>User Profile</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome, <?php echo $userData['username']; ?>!</h5>
            <p class="card-text">User ID: <?php echo $userData['id']; ?></p>
            <!-- <p class="card-text">Email: <?php echo $userData['email']; ?></p>  -->
            
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>

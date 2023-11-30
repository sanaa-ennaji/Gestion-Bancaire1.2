<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function authenticateUser($conn, $username, $password)
{
    $sql = "SELECT users.*, roles.name AS role_name 
            FROM users
            LEFT JOIN roles ON users.role_id = roles.id
            WHERE username = '$username' AND password = '$password'";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $user = authenticateUser($conn, $username, $password);

    // Debugging line
    var_dump($user);

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;

        // Debugging line
        var_dump($user['role_name']);

        if ($user['role_name'] == 'admin') {
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: userprofile.php");
            exit();
        }
    } else {
        $loginError = "Invalid username or password";
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
    <title>Login</title>
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
        <h1>Login</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <?php
                if (isset($loginError)) {
                    echo "<div class='alert alert-danger' role='alert'>$loginError</div>";
                }
                ?>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>








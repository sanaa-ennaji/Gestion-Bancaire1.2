<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT users.*, addresses.ville, agencies.latitude, roles.name AS role_name 
                                FROM users
                                LEFT JOIN addresses ON users.address_id = addresses.id
                                LEFT JOIN agencies ON users.agency_id = agencies.id
                                LEFT JOIN roles ON users.role_id = roles.id");

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>User List</title>
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
        <h1>User List</h1>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Confirm Password</th>
            <th>Address</th>
            <th>Agency Latitude</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['confirmPassword']}</td>
                    <td>{$row['ville']}</td>
                    <td>{$row['latitude']}</td>
                    <td>{$row['role_name']}</td>
                    <td>
                        <form action='{$_SERVER['PHP_SELF']}' method='post'>
                            <input type='hidden' name='user_id' value='{$row['id']}'>
                            <button type='submit' class='btn btn-danger' name='delete_user'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
    <script>
        feather.replace();
    </script>
</body>
</html>

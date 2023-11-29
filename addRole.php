<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Role
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_role"])) {
    $role_name = isset($_POST["role_name"]) ? $_POST["role_name"] : "";

    $sql = "INSERT INTO roles (name) VALUES ('$role_name')";

    // if (mysqli_query($conn, $sql)) {
    //     echo "Role added successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
}

// Delete Role
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_role"])) {
    $role_id = $_POST["role_id"];

    $deleteSql = "DELETE FROM roles WHERE id = $role_id";

    if (mysqli_query($conn, $deleteSql)) {
        echo "Role deleted successfully";
    } else {
        echo "Error deleting role: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Add role</title>
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
        <h1> Add role</h1>
    </div>

    <!-- Form to Add Role -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="role_name">Role Name:</label>
        <input type="text" name="role_name" class="form-control" required>
        <button type="submit" name="add_role" class="btn btn-primary">Add Role</button>
    </form>

    <hr>

    <!-- Display Roles -->
    <h2>Roles List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reopen the connection for fetching data
            $conn = new mysqli($host, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = mysqli_query($conn, "SELECT * FROM roles");

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>
                            <form action='{$_SERVER['PHP_SELF']}' method='post'>
                                <input type='hidden' name='role_id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger' name='delete_role'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }

            // Close the connection again after fetching data
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <script>
      feather.replace();
    </script>
</body>
</html>

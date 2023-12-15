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
    </style>
</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <!-- <li class="nav-item">
              <a class="nav-link active" href="agence.php">
                <i data-feather="corner-down-left"></i> Back to agences
              </a>
            </li> -->
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
        <div class="container mt-3 ">

    <div class="d-flex p-5 justify-content-between">
        <h1> Add  Role</h1>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="role_name">Role Name:</label>
        <input type="text" name="role_name" class="form-control " style="width: 600px"; required>
        <button type="submit" name="add_role" class="btn btn-primary mt-2">Add Role</button>
    </form>

    <hr>
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

            
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <script>
      feather.replace();
    </script>
</body>
</html>

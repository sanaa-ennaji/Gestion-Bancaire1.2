<?php
ob_start();
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_distributeur"])) {
    $distributeurs_id = $_POST["$distributeurs_id"];
    $sql = "DELETE FROM  distributeurs  WHERE id = $distributeurs_id";

    if (mysqli_query($conn, $sql)) {
        echo " distributeur deleted successfully";
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error deleting  distributeur: " . mysqli_error($conn);
    }
}
ob_end_flush(); 
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
      
       table{
        border: black;
       }
       nav{
        height: 100vh;
       }
    </style>
</head>
<body>
<nav style="hight:1000px;>
  <div class="container-fluid ">
    <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <!-- <a class="nav-link active" href="agence.php">
                <i data-feather="corner-down-left"></i> Back to agences
              </a> -->
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
                        <a class="nav-link" href="distribition">
                        <i data-feather="layers"></i> Distributors
                        </a>
                    </li>
             
                    <li class="nav-item">
                        <a class="nav-link " href="logout.php">
                        <i data-feather="log-out"></i> Log Out
                        </a>
                    </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="container mt-3 ">
<div class="container">
<div class="d-flex p-5 justify-content-between">
   <h1>distributeurs list</h1>
  <a href="addDISTRUBITION.php"> <i data-feather="plus-circle"></i></a>
</div>
</div>
    <table class="table">
        <thead>
        <tr>  
                <th>ID</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Address</th>
                <th>Bank id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM  distributeurs ");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['longitude']}</td>
                        <td>{$row['latitude']}</td>
                        <td>{$row['adresse']}</td>
                        <td>{$row['bank_id']}</td>
                        <td>
                            <form action='{$_SERVER['PHP_SELF']}' method='post'>
                                <input type='hidden' name='distributeurs_id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger' name='delete_distributeurs'>Delete</button>
                            </form>
                        </td>
                      </tr>";
                     }
                   ?>
                   
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
      feather.replace();
    </script>
</body>
</body>
</html>

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
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <Style>
        body{
            width: 100vw;
        }
        .table {
            width: 80%;
            margin: auto;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand p-2" href="#">central banking</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <ul class="navbar-nav d-flex justify-content-between ml-3">
      <li class="nav-item active">
        <a class="nav-link custom-link"class="navbar-brand" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item" >
        <a class="nav-link custom-link" href="#">Clients</a>
      </li>
      <li class="nav-item">
        <a class="nav-link custom-link" href="#">Addresses</a>
      </li>
    </ul>
  </div>
</nav>
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

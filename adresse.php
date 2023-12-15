<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Address
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_address"])) {
    $ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
    $quartier = isset($_POST["quartier"]) ? $_POST["quartier"] : "";
    $rue = isset($_POST["rue"]) ? $_POST["rue"] : "";
    $codePostal = isset($_POST["codePostal"]) ? $_POST["codePostal"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";

    $sql = "INSERT INTO addresses (ville, quartier, rue, codePostal, email, telephone) 
            VALUES ('$ville', '$quartier', '$rue', '$codePostal', '$email', '$telephone')";

    // if (mysqli_query($conn, $sql)) {
    //     echo "Address added successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
}

// Delete Address
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_address"])) {
    $address_id = $_POST["address_id"];

    $deleteSql = "DELETE FROM addresses WHERE id = $address_id";

    if (mysqli_query($conn, $deleteSql)) {
        echo "Address deleted successfully";
    } else {
        echo "Error deleting address: " . mysqli_error($conn);
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
        <h1> Add  adresse</h1>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="ville">Ville:</label>
            <input type="text" name="ville" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quartier">Quartier:</label>
            <input type="text" name="quartier" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="rue">Rue:</label>
            <input type="text" name="rue" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="codePostal">Code Postal:</label>
            <input type="text" name="codePostal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone:</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>
        <button type="submit" name="add_address" class="btn btn-primary">Add Address</button>
    </form>
    <hr>
    <h2>Addresses List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ville</th>
                <th>Quartier</th>
                <th>Rue</th>
                <th>Code Postal</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli($host, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = mysqli_query($conn, "SELECT * FROM addresses");

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['ville']}</td>
                        <td>{$row['quartier']}</td>
                        <td>{$row['rue']}</td>
                        <td>{$row['codePostal']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telephone']}</td>
                        <td>
                            <form action='{$_SERVER['PHP_SELF']}' method='post'>
                                <input type='hidden' name='address_id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger' name='delete_address'>Delete</button>
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

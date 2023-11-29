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
    <title>Add Address</title>
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
        <h1>Add Address</h1>
    </div>

    <!-- Form to Add Address -->
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

    <!-- Display Addresses -->
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
            // Reopen the connection for fetching data
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

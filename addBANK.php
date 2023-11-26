<?php
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$dbname = 'bank';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {  
     die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $logoTmpName = $_FILES["logo"]["tmp_name"];
    $logoType = $_FILES["logo"]["type"];

    if ($logoType == "image/jpeg" || $logoType == "image/png" || $logoType == "image/gif") {
        $logo = addslashes(file_get_contents($logoTmpName));

        // Insert bank
        $sql = "INSERT INTO banks (name, logo) VALUES ('$name', '$logo')";

        if (mysqli_query($conn, $sql)) {
            echo "Bank added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Add Bank</title>
</head>
<body>
<div class="container mt-5">
<div class="d-flex p-5 justify-content-between">
   <h1>banks list</h1>
  <a href="bank.php"><i data-feather="corner-down-left"></i></a>
</div>
<h2>Add Bank</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Bank Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="logo">Logo:</label>
            <input type="file" class="form-control-file" name="logo" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Bank</button>
    </form>
</div>

<script>
      feather.replace();
    </script>
</body>
</html>


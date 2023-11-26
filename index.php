 <!-- config + connection + TAPLES -->
<?php
    $host = 'localhost';
    $username = 'root';
    $password = 'new_password';
    $databaseName = 'bank';
    
    $conn = mysqli_connect($host, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS bank";

    if ($conn->query($sql) === TRUE) {
        echo "Database '$databaseName' created successfully.\n";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn = mysqli_connect($host, $username, $password, $databaseName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //taple of banks 
    $sql = "CREATE TABLE IF NOT EXISTS banks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        logo LONGBLOB
    )";
    
if ($conn->query($sql) === TRUE) {
    echo "Clients table created successfully";
} else {
    echo "Error creating clients table: " . $conn->error;
}

    $conn->close();
    ?>

















<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>bank </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo"> <img src="img/bank.png" alt=""></label>
      <ul>
        <li><a class="active" href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">FAQ</a></li>
      </ul>
    </nav>
    <section>
<div class="content">
<h1>bienvenue! dans notre<br> système bancaire central</h1>
<div class="btn">
 <a href="adminlogin.php"><button>admin login</button></a>
<button>client login</button>
</div>
</div>
<img src="img/banking-illustration.png" alt="bank">
    </section>
  </body>
</html> -->
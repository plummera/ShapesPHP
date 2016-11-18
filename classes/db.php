<?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "root";
  $db = "Shapes";
  // Connect to the database
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error . "\n");
  }
  echo "Connected Successfully \n";

  function createDatabase() {
    // Create database
    $sql = "CREATE DATABASE SHAPES";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();
  }

  function fetchAll() {
    $sql="SELECT Length,Width FROM Shapes ORDER BY ID";
    $result=mysqli_query($con,$sql);

    if ($conn->query($sql) === TRUE) {
      // Fetch all
      mysqli_fetch_all($result,MYSQLI_ASSOC);

      // Free result set
      mysqli_free_result($result);
    }

    $conn->close();
  }

?>

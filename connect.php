<?php
  $conn = mysqli_connect('localhost', 'root', '', 'pizza');
  if ($conn->error) {
    echo "An error has occurred: " . $conn->error;
  }
?>

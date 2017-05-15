<?php
  $conn = new mysqli('localhost', 'root', '', 'pizza');
  if ($conn->error) {
    echo "An error has occurred: " . $conn->error;
  }
?>

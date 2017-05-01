<?php
  $conn = mysqli_connect('localhost', 'root', '', 'pizza_new');
  if ($conn->error) {
    echo "An error has occurred: " . $conn->error;
  }
?>

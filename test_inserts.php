<?php
  include('requires.php');

  save_pizza(14.50, 2, 2, [1,3,4,5,6,10], $conn);
  save_pizza(11.50, 1, 1, [2,4,5,6,10], $conn);
  save_pizza(18.00, 3, 2, [1,2,3,4,10,11], $conn);
?>

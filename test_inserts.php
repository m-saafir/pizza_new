<?php
  include('requires.php');

  $sizeID = 3; //Large
  $toppingIDs = [1,2,5,7,8,10];
  $price = 14.50;

  save_pizza($price, $sizeID, 1, $toppingIDs, $conn);
?>

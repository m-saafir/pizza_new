<?php
  require_once('connect.php');
  require_once('functions.php');
  $order_types = select('p_order_types', $conn);
  $sizes = select('p_pizza_sizes', $conn, "WHERE active_sw = 'Y'");
  $cheeses = select('p_toppings', $conn, "WHERE topping_category_id = 1 AND active_sw = 'Y'");
  $meats = select('p_toppings', $conn, "WHERE topping_category_id = 2 AND active_sw = 'Y'");
  $veggies = select('p_toppings', $conn, "WHERE topping_category_id = 3 AND active_sw = 'Y'");
  $fruits = select('p_toppings', $conn, "WHERE topping_category_id = 4 AND active_sw = 'Y'");
  global $ERROR;
?>

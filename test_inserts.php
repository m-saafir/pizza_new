<?php
  include('requires.php');

  $description = 'supreme';
  $size = 2;
  $toppings = [1,2,3,4,5];

  function savePizza($description, $size, $toppings, $connection) {
    $price = getPriceOfPizza($toppings);

    $pizza_sql = "INSERT INTO p_pizza (pizza_desc, price) VALUES ('hello', $price)";
    echo $pizza_sql;
    gen_sql($pizza_sql, $connection);
    $pizzaID = $connection->insert_id;

    foreach ($toppings as $topping) {
      savePizzaTopping($pizzaID, $topping, $connection);
    }
  }

  function savePizzaTopping($id, $topping, $connection) {
    $sql = "INSERT INTO p_pizza_topping (pizza_id, topping_id) VALUES ($id, $topping)";
    $connection->query($sql);
  }

  function getPriceOfPizza($toppings) {
    return 4 * sizeof($toppings);
  }

  savePizza($description, $size, $toppings, $conn);
  echo $GLOBALS['error'];
?>

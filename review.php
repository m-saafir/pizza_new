<?php
  require('requires.php');
  $order_type_code = isset($_REQUEST['order_type']) ? $_REQUEST['order_type'] : null;
  $size_id = isset($_REQUEST['size']) ? $_REQUEST['size'] : null;
  $cheese_id = isset($_REQUEST['cheese']) ? $_REQUEST['cheese'] : null;
  $meats = isset($_REQUEST['meats']) ? $_REQUEST['meats'] : null;
  $veggies = isset($_REQUEST['veggies']) ? $_REQUEST['veggies'] : null;
  $fruits = isset($_REQUEST['fruits']) ? $_REQUEST['fruits'] : null;
  $prices = [];

  $res = select('p_order_types', $conn, 'WHERE order_type_cd = '.$order_type_code);
  $row = $res->fetch_object();
  $order_type = $row->order_type_cd_desc;

  $res = select('p_pizza_sizes', $conn, 'WHERE size_id = '.$size_id);
  $row = $res->fetch_object();
  $size = $row->size_desc;
  $size_price = $row->price;
  $prices[] = $size_price;

  $res = select('p_toppings', $conn, 'WHERE topping_id = '.$cheese_id);
  $row = $res->fetch_object();
  $cheese = $row->topping_desc;
  $cheese_price = $row->topping_price;
  $prices[] = $cheese_price;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container container-fluid col-md-9">
      <h1>Your Pizza</h1>
      <ul>
        <li><?php echo $order_type; ?> order</li>
        <li><?php echo $size.' pizza $'.$size_price; ?></li>
        <li><?php echo $cheese.' $'.$cheese_price; ?></li>
        <?php
          foreach ($meats as $meat) {
            $res = select('p_toppings', $conn, 'WHERE topping_id = '.$meat);
            while ($row = $res->fetch_object()) {
              echo '<li>'.$row->topping_desc.' $'.$row->topping_price.'</li>';
              $prices[] = $row->topping_price;
            }
          }

          foreach ($veggies as $veggie) {
            $res = select('p_toppings', $conn, 'WHERE topping_id = '.$veggie);
            while ($row = $res->fetch_object()) {
              echo '<li>'.$row->topping_desc.' $'.$row->topping_price.'</li>';
              $prices[] = $row->topping_price;
            }
          }

          foreach ($fruits as $fruit) {
            $res = select('p_toppings', $conn, 'WHERE topping_id = '.$fruit);
            while ($row = $res->fetch_object()) {
              echo '<li>'.$row->topping_desc.' $'.$row->topping_price.'</li>';
              $prices[] = $row->topping_price;
            }
          }
        ?>
      </ul>
      <span>Total Price: $<?php echo number_format(array_sum($prices), 2); ?></span>
    </div>
  </body>
</html>

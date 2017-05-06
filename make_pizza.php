<?php
  require_once('connect.php');
  require_once('functions.php');
  require_once('variables.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Design Your Pizza</h1>
    <form action="/review.php" method="POST">
      <label for="order_type">Order Type</label>
      <?php while ($row = $order_types->fetch_object()) { ?>
        <input type="radio" name="order_type" value="<?php echo $row->order_type_cd; ?>"><?php echo $row->order_type_cd_desc; ?></input>
      <?php } ?>
      <br>
      <label for="size">Size</label>
      <?php while ($row = $sizes->fetch_object()) { ?>
        <input type="radio" name="size" value="<?php echo $row->size_id; ?>"><?php echo $row->size_desc; ?></input>
      <?php } ?>
      <br>
      <label for="cheese">Cheese</label>
      <?php while ($row = $cheeses->fetch_object()) {?>
        <input type="radio" name="cheese" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
      <?php } ?>
      <br>
      <label for="meat">Meat
      <?php while ($row = $meats->fetch_object()) {?>
        <input type="checkbox" name="meat" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
      <?php } ?>
      <br>
      <label for="veggies">Vegetables</label>
      <?php while ($row = $veggies->fetch_object()) {?>
        <input type="checkbox" name="veggies" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
      <?php } ?>
      <br>
      <label for="fruit">Fruits</label>
      <?php while ($row = $fruits->fetch_object()) {?>
        <input type="checkbox" name="fruit" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
      <?php } ?>
      <br>
      <button type="submit">Submit</button>
    </form>
  </body>
</html>

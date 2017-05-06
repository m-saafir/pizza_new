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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <h1>Design Your Pizza</h1>
      <form action="/review.php" method="POST">
        <div class="form-group">
          <label for="order_type">Order Type</label>
          <?php while ($row = $order_types->fetch_object()) { ?>
            <input type="radio" name="order_type" value="<?php echo $row->order_type_cd; ?>"><?php echo $row->order_type_cd_desc; ?></input>
          <?php } ?>
        </div>

        <div class="form-group">
          <label for="size">Size</label>
          <?php while ($row = $sizes->fetch_object()) { ?>
            <input type="radio" name="size" value="<?php echo $row->size_id; ?>"><?php echo $row->size_desc; ?></input>
          <?php } ?>
        </div>

        <div class="form-group">
          <label for="cheese">Cheese</label>
          <?php while ($row = $cheeses->fetch_object()) {?>
            <input type="radio" name="cheese" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
          <?php } ?>
        </div>

        <div class="form-group">
          <label for="meat">Meat
          <?php while ($row = $meats->fetch_object()) {?>
            <input type="checkbox" name="meat" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
          <?php } ?>
        </div>

        <div class="form-group">
          <label for="veggies">Vegetables</label>
          <?php while ($row = $veggies->fetch_object()) {?>
            <input type="checkbox" name="veggies" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
          <?php } ?>
        </div>

        <div class="form-group">
          <label for="fruit">Fruits</label>
          <?php while ($row = $fruits->fetch_object()) {?>
            <input type="checkbox" name="fruit" value="<?php echo $row->topping_id; ?>"><?php echo $row->topping_desc.' $'.$row->topping_price; ?></input>
          <?php } ?>
        </div>

        <div class="form-group">
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>

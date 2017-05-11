<?php
  require('requires.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.min.css">
  </head>
  <body>
    <div class="container container-fluid col-md-9">
      <h1>Design Your Pizza</h1>
      <form action="review.php" method="POST">
        <div class="form-group">
          <span>Order Type</span>
          <?php while ($row = $order_types->fetch_object()) { ?>
            <label>
              <input type="radio" name="order_type" value="<?php echo $row->order_type_cd; ?>">
              <?php echo $row->order_type_cd_desc; ?>
            </label>
          <?php } ?>
        </div>

        <div class="form-group">
          <span>Size</span>
          <?php while ($row = $sizes->fetch_object()) { ?>
            <label>
              <input type="radio" name="size" value="<?php echo $row->size_id; ?>">
              <?php echo $row->size_desc.' $'.$row->price; ?>
            </label>
          <?php } ?>
        </div>

        <div class="form-group">
          <span>Cheese</span>
          <?php while ($row = $cheeses->fetch_object()) {?>
            <label>
              <input type="radio" name="cheese" value="<?php echo $row->topping_id; ?>">
              <?php echo $row->topping_desc.' $'.$row->topping_price; ?>
            </label>
          <?php } ?>
        </div>

        <div class="form-group">
          <span>Meat</span>
          <?php while ($row = $meats->fetch_object()) {?>
            <label>
              <input type="checkbox" name="meats[]" value="<?php echo $row->topping_id; ?>">
              <?php echo $row->topping_desc.' $'.$row->topping_price; ?>
            </label>
          <?php } ?>
        </div>

        <div class="form-group">
          <span>Vegetables</span>
          <?php while ($row = $veggies->fetch_object()) {?>
            <label>
              <input type="checkbox" name="veggies[]" value="<?php echo $row->topping_id; ?>">
              <?php echo $row->topping_desc.' $'.$row->topping_price; ?>
            </label>
          <?php } ?>
        </div>

        <div class="form-group">
          <span>Fruits</span>
          <?php while ($row = $fruits->fetch_object()) {?>
            <label>
              <input type="checkbox" name="fruits[]" value="<?php echo $row->topping_id; ?>">
              <?php echo $row->topping_desc.' $'.$row->topping_price; ?>
            </label>
          <?php } ?>
        </div>

        <div class="form-group">
          <button class="btn btn-primary btn-lg" type="submit">Submit</button>
        </div>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>

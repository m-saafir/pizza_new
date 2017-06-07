<?php
  require('requires.php');
  $order_id = isset($_REQUEST['order_id']) ? $_REQUEST['order_id'] : null;
  $customer_id = isset($_REQUEST['customer_id']) ? $_REQUEST['customer_id'] : null;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <table class="table table-responsive">
      <thead class="thead-default">
        <th>ORDER</th>
        <th>SIZE</th>
        <th>TOTAL PRICE</th>
        <th>LASTMOD</th>
      </thead>
      <?php
        $detail_sql = <<<SQL
          SELECT
            order_id,
            size_desc,
            pizza_price,
            pizza_id,
            lastmod
          FROM
            p_order_details OD
          INNER JOIN
            p_pizza_sizes S
          ON
            OD.size_id = S.size_id
          WHERE
            order_id = $order_id
SQL;
        if ($result = gen_sql($detail_sql, $conn)) {
          while ($row = $result->fetch_object()) {
            echo <<<ROW
              <tr>
                <td>$row->order_id</td>
                <td>$row->size_desc</td>
                <td>$$row->pizza_price</td>
                <td>$row->lastmod</td>
              </tr>
ROW;
            $pizza_id = $row->pizza_id;
          }
        } else {
          echo $GLOBALS['error'];
        }
      ?>
    </table>
    <div class="col-xs-2">
      <table class="table table-hover table-responsive">
        <thead class="thead-default">
          <th>TOPPING</th>
          <th>PRICE</th>
        </thead>
        <?php
          $topping_sql = <<<SQL
            SELECT
              topping_desc,
              topping_price
            FROM
              p_toppings
            WHERE
              topping_id IN (
                SELECT
                  topping_id
                FROM
                  p_pizza_topping
                WHERE
                  pizza_id = $pizza_id
              )
SQL;
          if ($result = gen_sql($topping_sql, $conn)) {
            while ($row = $result->fetch_object()) {
              echo <<<ROW
                <tr>
                  <td>$row->topping_desc</td>
                  <td>$$row->topping_price</td>
                </tr>
ROW;
            }
          } else {
            echo $GLOBALS['error'];
          }
         ?>
      </table>
    </div>
    <div class="col-xs-5">
      <table class="table table-responsive">
        <thead class="thead-default">
          <th>NAME</th>
          <th>EMAIL</th>
          <th>PHONE</th>
          <th>SECONDARY PHONE</th>
        </thead>
        <?php
          $customer_sql = <<<SQL
            SELECT
              customer_id,
              first_name,
              last_name,
              email_id,
              pri_phone,
              alt_phone
            FROM
              p_customer
            WHERE
              customer_id = $customer_id
SQL;
          if ($result = gen_sql($customer_sql, $conn)) {
            while ($row = $result->fetch_object()) {
              echo <<<ROW
                <tr>
                  <td>$row->first_name $row->last_name</td>
                  <td>$row->email_id</td>
                  <td>$row->pri_phone</td>
                  <td>$row->alt_phone</td>
                </tr>
ROW;
            }
          } else {
            echo $GLOBALS['error'];
          }
        ?>
      </table>
    </div>
    <a href="orders.php">
      <button class="btn btn-warning">Go Back</button>
    </a>
  </body>
</html>

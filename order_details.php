<?php
  require('requires.php');
  $order_id = isset($_REQUEST['order_id']) ? $_REQUEST['order_id'] : null;
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
          }
         ?>
      </table>
    </div>
  </body>
</html>

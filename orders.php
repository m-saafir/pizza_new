<?php
  require('requires.php');
  $complete_id = isset($_REQUEST['complete_id']) ? $_REQUEST['complete_id'] : null;
  $incomplete_id = isset($_REQUEST['undocomplete_id']) ? $_REQUEST['undocomplete_id'] : null;
  if (!empty($complete_id)) {
    $update_sql = "UPDATE p_orders SET order_status_cd = 3 WHERE order_id = $complete_id";
    if (!gen_sql($update_sql, $conn)) {
      echo $GLOBALS['error'];
    }
  } elseif (!empty($incomplete_id)) {
    $update_sql = "UPDATE p_orders SET order_status_cd = 1 WHERE order_id = $incomplete_id";
    if (!gen_sql($update_sql, $conn)) {
      echo $GLOBALS['error'];
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <table class="table table-hover">
      <thead class="thead-default">
        <th>ID</th>
        <th>CUSTOMER</th>
        <th>DATE</th>
        <th>ORDER TYPE</th>
        <th>ORDER STATUS</th>
        <th>TOTAL PRICE</th>
        <th>DISCOUNT CODE</th>
        <th>REMARKS</th>
        <th>LASTMOD</th>
        <th>DETAILS</th>
        <th>COMPLETE</th>
      </thead>
      <?php
        $select_sql = <<<SQL
          SELECT
            O.order_id,
            O.customer_id,
            C.first_name,
            C.last_name,
            order_date,
            order_type_cd_desc,
            O.order_status_cd,
            order_status_cd_desc,
            pizza_price,
            discount_cd,
            remarks,
            O.lastmod
          FROM
            p_orders O,
            p_order_details OD,
            p_order_types OT,
            p_order_status_codes OS,
            p_customer C
          WHERE
            O.order_id = OD.order_id
          AND
            O.order_type_cd = OT.order_type_cd
          AND
            O.order_status_cd = OS.order_status_cd
          AND
            O.customer_id = C.customer_id
          ORDER BY order_date DESC, lastmod DESC
          LIMIT 10
SQL;
        if ($result = gen_sql($select_sql, $conn)) {
          while ($row = $result->fetch_object()) {
            echo <<<ROW
              <tr>
                <td>$row->order_id</td>
                <td>$row->first_name $row->last_name</td>
                <td>$row->order_date</td>
                <td>$row->order_type_cd_desc</td>
                <td>$row->order_status_cd_desc</td>
                <td>$$row->pizza_price</td>
                <td>$row->discount_cd</td>
                <td>$row->remarks</td>
                <td>$row->lastmod</td>
                <td>
                  <form action="order_details.php" method="POST">
                    <input name="order_id" type="hidden" value="$row->order_id">
                    <input name="customer_id" type="hidden" value="$row->customer_id">
                    <button class="btn btn-info" type="submit">Details</button>
                  </form>
                </td>
ROW;
            if ($row->order_status_cd != 3) {
              echo <<<BUTTON
                <td>
                  <form action="orders.php" method="POST">
                    <input name="complete_id" type="hidden" value="$row->order_id">
                    <button class="btn btn-success" type="submit">Complete Order</button>
                  </form>
                </td>
BUTTON;
            } else {
              echo <<<BUTTON
                <td>
                  <form action="orders.php" method="POST">
                    <input name="undocomplete_id" type="hidden" value="$row->order_id">
                    <button class="btn btn-warning" type="submit">Undo</button>
                  </form>
                </td>
BUTTON;
            }
            echo "</tr>";
          }
        } else {
          echo $GLOBALS['error'];
        }
      ?>
    </table>
  </body>
</html>

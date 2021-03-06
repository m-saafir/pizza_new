<?php
  require_once('variables.php');
  function gen_sql(string $sql, mysqli $connection) {
    if (!($result = $connection->query($sql))) {
      $GLOBALS['error'] = $connection->error;
      return 0;
    }
    return $result;
  }

  function select(string $table, mysqli $connection, string $where = null) {
    $sql = "select * from {$table}";
    if (!empty($where)) {
      $sql = $sql." ".$where;
    }
    if (!($result = $connection->query($sql))) {
      $GLOBALS['error'] = $connection->error;
      return 0;
    }
    return $result;
  }

  function save_pizza(float $price, int $size_id, int $order_type_cd, array $topping_ids, mysqli $connection) {
    $pizza_sql = "INSERT INTO p_pizza (price) VALUES ($price)";
    if (!gen_sql($pizza_sql, $connection)) {
      return 0;
    }
    $pizza_id = $connection->insert_id;

    $customer_sql = "INSERT INTO p_customer (first_name, last_name, email_id) VALUES ('BLAH', 'BLAH', 'blah@blah.com')";
    if (!gen_sql($customer_sql, $connection)) {
      return 0;
    }
    $customer_id = $connection->insert_id;

    $orders_sql = "INSERT INTO p_orders (order_date, order_type_cd, order_status_cd, customer_id) VALUES (CURRENT_DATE, $order_type_cd, 1, $customer_id)";
    if (!gen_sql($orders_sql, $connection)) {
      return 0;
    }
    $order_id = $connection->insert_id;

    foreach ($topping_ids as $topping) {
      $topping_sql = "INSERT INTO p_pizza_topping (pizza_id, topping_id) VALUES ($pizza_id, $topping)";
      if (!gen_sql($topping_sql, $connection)) {
        return 0;
      }
    }

    $order_details_sql = "INSERT INTO p_order_details (order_id, pizza_id, size_id, pizza_topping_id, pizza_price) VALUES ($order_id, $pizza_id, $size_id, $pizza_id, $price)";
    if (!gen_sql($order_details_sql, $connection)) {
      return 0;
    }
  }
?>

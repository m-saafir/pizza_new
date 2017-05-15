<?php
  require_once('variables.php');
  function gen_sql($sql, mysqli $connection) {
    if (!($result = $connection->query($sql))) {
      $GLOBALS['error'] = $connection->error;
      return 0;
    }
    return 1;
  }

  function select($table, mysqli $connection, $where = null) {
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

  function save_pizza($price, array $topping_ids, mysqli $connection) {
    $pizza_sql = "INSERT INTO p_pizza (price) VALUES ($price)";
    gen_sql($pizza_sql, $connection);
    $pizza_id = $connection->insert_id;

    foreach ($topping_ids as $topping) {
      $topping_sql = "INSERT INTO p_pizza_topping (pizza_id, topping_id) VALUES ($pizza_id, $topping)";
      gen_sql($topping_sql, $connection);
    }
  }
?>

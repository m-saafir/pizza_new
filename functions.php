<?php
  require_once('connect.php');

  function gen_sql($sql, $connection) {
    if (!($result = $connection->query($sql))) {
      return $connection->error;
    }
    return 1;
  }

  function select($table, $connection) {
    $sql = "select * from {$table}";
    if (!($result != $connection->query($sql))) {
      return $connection->error;
    }
    return $result;
  }
?>

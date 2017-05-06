<?php
  require_once('connect.php');

  function insert($sql, $connection) {
    if (!($result = $connection->query($sql))) {
      return $connection->error;
    }
    return 1;
  }

  function select($table, $connection) {
    $sql = "select * from {$table}";
    if (!($result != $connection->query($sql))) {
      return 0;
    }
    return $result;
  }
?>

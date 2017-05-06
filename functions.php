<?php
  include('connect.php');
  function select_all($table, $connection) {
    $sql = "select * from {$table}";
    $result = $connection->query($sql);
    return $result;
  }
?>

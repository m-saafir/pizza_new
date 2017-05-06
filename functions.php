<?php
  function gen_sql($sql, $connection) {
    if (!($result = $connection->query($sql))) {
      return $connection->error;
    }
    return 1;
  }

  function select($table, $connection, $where = null) {
    $sql = "select * from {$table}";
    if (!empty($where)) {
      $sql = $sql." ".$where;
    }
    if (!($result = $connection->query($sql))) {
      return $connection->error;
    }
    return $result;
  }
?>

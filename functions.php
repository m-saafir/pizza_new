<?php
  require_once('variables.php');
  function gen_sql($sql, $connection) {
    if (!($result = $connection->query($sql))) {
      $ERROR = $connection->error;
      return 0;
    }
    return 1;
  }

  function select($table, $connection, $where = null) {
    $sql = "select * from {$table}";
    if (!empty($where)) {
      $sql = $sql." ".$where;
    }
    if (!($result = $connection->query($sql))) {
      $ERROR = $connection->error;
      return 0
    }
    return $result;
  }
?>

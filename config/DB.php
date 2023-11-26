<?php

class DB {
  public static function connect()
  {
    try {
      $conn = new mysqli('localhost', 'root', '', 'mvc');
      $conn->query("SET NAMES 'utf8'");
      
      return $conn;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }
}

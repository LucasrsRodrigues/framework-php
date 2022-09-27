<?php

class Json
{
  private function __construct()
  {
  }

  public static function getInstance()
  {
    static $inst = null;
    if ($inst === null) {
      $inst = new Router();
    }

    return $inst;
  }

  public function returnJson($array)
  {
    header("Content-Type: application/json");
    echo json_encode($array);
    exit;
  }
}

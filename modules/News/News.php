<?php

class News
{
  private $db;

  private function __construct()
  {
    $core = Core::getInstance();
    $this->db = $core->loadModule('database');
  }

  public static function getInstance()
  {
    static $inst = null;
    if ($inst === null) {
      $inst = new Router();
    }

    return $inst;
  }

  public function getNewsList()
  {
    $array = array();

    $sql = $this->db->query("SELECT * FROM noticias");

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
}

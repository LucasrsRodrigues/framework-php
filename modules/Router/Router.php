<?php

class Router
{
  private $core;
  private $get;
  private $post;

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

  public function load()
  {
    $this->core = Core::getInstance();
    $this->loadRouteFile('default');

    return $this;
  }

  public function loadRouteFile($fileName)
  {
    if (file_exists('routes/' . $fileName . '.php')) {
      require 'routes/' . $fileName . '.php';
    }
  }

  public function match()
  {
    $url = (isset($_GET['url']) ? $_GET['url'] : '');

    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
      default:
        $type = $this->get;
        break;
      case 'POST':
        $type = $this->post;
        break;
    }

    foreach ($type as $pt => $func) {
      $pattern = preg_replace('(\{[a-z0-9]{0,}\})', '([a-z0-9]{0,})', $pt);

      if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
        array_shift($matches);
        array_shift($matches);

        $itens = array();

        if (preg_match('(\{[a-z0-9]{0,}\})', $pt, $m)) {
          $itens = preg_replace('(\{|\})', '', $m[0]);
        }

        $arg = array();

        foreach ($matches as $key => $match) {
          $arg[$itens[$key]] = $match;
        }

        $func($arg);
        break;
      }
    }
  }

  public function get($pattern, $function)
  {
    $this->get[$pattern] = $function;
  }

  public function post($pattern, $function)
  {
    $this->post[$pattern] = $function;
  }
}

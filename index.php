<?php
session_start();
require 'config.php';

spl_autoload_register(function ($class) {
  if (file_exists('module/' . $class . '/' . $class . '.php')) {
    require 'module/' . $class . '/' . $class . '.php';
  }
});


Core::getInstance()->run($config);

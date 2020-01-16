<?php

spl_autoload_register(function($class_name) {
  $path = __DIR__ . '/lib/' . str_replace('\\', '/', str_replace('BlockChyp\\', '', $class_name)) . '.php';
  if (file_exists($path)) {
    require $path;
  }
});

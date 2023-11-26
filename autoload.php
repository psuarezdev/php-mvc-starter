<?php

spl_autoload_register(function($classname) {
  $paths = [
    'config/',
    'controllers/'
  ];

  foreach ($paths as $path) {
    $file = $path . $classname . '.php';
    if (file_exists($file))
      include $file;
  }
});

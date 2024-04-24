<?php
require __DIR__.'/config.php';

spl_autoload_register(function($class) {
    include __DIR__.'/lib/' . str_replace('\\', '/', $class) . '.php';
});

use Config\Config;

$config = Config::getInstance();
$config->initConfig($vars);
?>
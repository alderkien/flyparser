<?php
namespace Config;

class Config 
{
    protected static self|null $instance = null;

    final private function __construct(){}
    final protected function __clone(){}

    private static $config = [];

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function initConfig(array $config)
    {
        static::$config = $config;
    }

    public function getVar($var)  {
        if(!empty(self::$config[$var])) {
            return self::$config[$var];
        }

        return null;
    }
}
?>
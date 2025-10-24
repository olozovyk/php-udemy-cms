<?php

namespace App\Support;

class Container
{
    private array $instances = [];
    private array $recipes = [];
    private static Container $container;

    private function __construct()
    {
    }

    static function getContainer(): Container
    {
        if (!isset(self::$container)) {
            self::$container = new self();
        }
        return self::$container;
    }

    public function bind(string $instanceKey, \Closure $recipe): void
    {
        $this->recipes[$instanceKey] = $recipe;
    }

    public function get(string $instance)
    {
        if (!isset($this->recipes[$instance])) {
            echo "Instance $instance has not been registered.";
            die();
        }
        if (!isset($this->instances[$instance])) {
            $this->instances[$instance] = $this->recipes[$instance]();
        }
        return $this->instances[$instance];
    }
}
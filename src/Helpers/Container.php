<?php

namespace DarkTec\Helpers;

class Container
{
    private static $instance = null;

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new \DI\Container();
        }

        return self::$instance;
    }
}

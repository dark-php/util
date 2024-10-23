<?php

namespace DarkTec\Helpers;

class Blade {

    private static ?\Lexdubyna\Blade\Blade $blade = null;

    public static function getBlade() {

        if (self::$blade == null) {
            self::$blade = new \Lexdubyna\Blade\Blade('views', 'cache');
        }

        return self::$blade;
    }

    public static function addComponents($components = []) {
        $blade = self::getBlade();
        $blade->compiler()->components($components);
    }
}
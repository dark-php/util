<?php
namespace Darktec\Tests;

use Darktec\Util\Map;

class TestMap extends Map {
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }
}
<?php
namespace Darktec\Tests;

use Darktec\Util\Collection;

class TestCollection extends Collection {
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }
}
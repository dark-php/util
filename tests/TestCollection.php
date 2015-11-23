<?php
namespace Darktec\Util\Tests;

use Darktec\Util\Collection;

class TestCollection extends Collection {
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }
}
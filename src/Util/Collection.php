<?php
namespace Darktec\Util;

use JsonSerializable;
use Countable;
use ArrayAccess;
use IteratorAggregate;
use ArrayIterator;
use Darktec\Error\InvalidKeyException;

/**
 * Darktec Util: Collection
 *
 * This class is an array wrapper that allows you to have object indexes and provides common functions
 * for collection objects
 *
 * @author David Hopson <mantle@hotmail.co.uk>
 * @version 1.0
 * @package Darktec\Util
 */

abstract class Collection implements Arrayable, ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * The items stored in the collection
     *
     * @var array
     */
    protected $items = [];

    /**
     * Collection constructor creates a collection using given array.
     * @param array
     */
    public function __construct(array $items = []) {
        $this->items = $items;
    }

    /**
     * Add an object to the collection
     *
     * @param mixed
     * @param mixed
     * @return void
     */
    public function add($index, $value) {
        $this->offsetSet($index, $value);
    }

    /**
     * Get an object from the collection
     *
     * @param mixed
     * @return mixed
     * @throws \Darktec\Error\InvalidKeyException
     */
    public function get($index) {
        if ($this->offsetExists($index)) {
            return $this->offsetGet($index);
        } else {
            throw new InvalidKeyException("Invalid index $index.");
        }
    }

    /**
     * Removes an object from the collection
     *
     * @param mixed
     * @return void
     * @throws \Darktec\Error\InvalidKeyException
     */
    public function delete($index) {
        if ($this->offsetExists($index)) {
            $this->offsetUnset($index);
        } else {
            throw new InvalidKeyException("Invalid index $index.");
        }
    }

    /**
     * Returns the collections keys
     *
     * @return int[]
     */
    public function keys(): array {
        return array_keys($this->items);
    }

    /**
     * Check whether the collection contains an object from given key
     * @param mixed
     * @return bool
     */
    public function contains($index): bool {
        return array_key_exists($index, $this->items);
    }

    /**
     * Returns length of the collection
     *
     * @return int
     */
    public function length(): int {
        return count($this->items);
    }

    // TODO: DOCS FROM HERE ON

    public function all() : array {
        return $this->items;
    }

    public function search($item, bool $strict = false) {
        return array_search($item, $this->items, $strict);
    }

    public function getIterator() {
        return new ArrayIterator($this);
    }

    public function offsetSet($offset, $item) {
        is_null($offset) ? $this->items[] = $item : $this->items[$offset] = $item;

    }

    public function offsetExists($offset) {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function count()
    {
        return count($this->items);
    }

    public function jsonSerialize()
    {
        return array_map(function ($item) {
            return $item instanceof JsonSerializable ? $item->jsonSerialize() : ($item instanceof Arrayable ? $item->toArray() : $item);
        }, $this->items);
    }

    public function toArray() {
        return array_map(function ($item) {
            return $item instanceof Arrayable ? $item->toArray() : $item;
        }, $this->items);
    }

    public function toJson() {
        return json_encode($this->jsonSerialize());
    }

}
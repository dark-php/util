<?php
namespace Darktec\Util;

use Darktec\Error\InvalidKeyException;

abstract class Map
{

    protected $items;

    /**
     * Add an object to the map
     *
     * @param string
     * @param mixed
     * @return void
     */
    public function add(string $key, $value)
    {
        $this->items[$key] = $value;
    }

    /**
     * Get an object from the map
     *
     * @param string
     * @return object
     * @throws \Darktec\Error\InvalidKeyException
     */
    public function get(string $index)
    {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        } else {
            throw new InvalidKeyException("Invalid index $index.");
        }
    }

    /**
     * Removes an object from the map
     *
     * @param string
     * @return void
     * @throws \Darktec\Error\InvalidKeyException
     */
    public function delete(string $index)
    {
        if (isset($this->items[$index])) {
            unset($this->items[$index]);
        } else {
            throw new InvalidKeyException("Invalid index $index.");
        }
    }

    /**
     * Returns the map keys
     *
     * @return string[]
     */
    public function keys(): array
    {
        return array_keys($this->items);
    }

    /**
     * Checks whether a given key exists
     *
     * @param string
     * @return bool
     */
    public function keyExists(string $index): bool
    {
        return isset($this->items[$index]);
    }

    /**
     * Check whether the map contains an object
     * @param mixed
     * @return bool
     */
    public function contains($item): bool
    {
        return in_array($item, $this->items);
    }

    /**
     * Returns length of the map
     *
     * @return int
     */
    public function length(): int
    {
        return count($this->items);
    }
}
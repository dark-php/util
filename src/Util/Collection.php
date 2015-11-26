<?php
namespace Darktec\Util;

use Darktec\Error\InvalidKeyException;

abstract class Collection
{
    protected $items;

    /**
     * Add an object to the collection
     *
     * @param mixed
     * @return void
     */
    public function add($item)
    {
        $this->items[] = $item;
    }

    /**
     * Get an object from the collection
     *
     * @param int
     * @return mixed
     * @throws \Darktec\Error\InvalidKeyException
     */
    public function get(int $index)
    {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        } else {
            throw new InvalidKeyException("Invalid index $index.");
        }
    }

    /**
     * Removes an object from the collection
     *
     * @param int
     * @return void
     * @throws \Darktec\Error\InvalidKeyException
     */
    public function delete(int $index)
    {
        if (isset($this->items[$index])) {
            unset($this->items[$index]);
        } else {
            throw new InvalidKeyException("Invalid index $index.");
        }
    }

    /**
     * Returns the collections keys
     *
     * @return int[]
     */
    public function keys(): array
    {
        return array_keys($this->items);
    }

    /**
     * Checks whether a given key exists
     *
     * @param int
     * @return bool
     */
    public function keyExists(int $index): bool
    {
        return isset($this->items[$index]);
    }

    /**
     * Check whether the collection contains an object
     * @param mixed
     * @return bool
     */
    public function contains($item): bool
    {
        return in_array($item, $this->items);
    }

    /**
     * Returns length of the collection
     *
     * @return int
     */
    public function length(): int
    {
        return count($this->items);
    }
}
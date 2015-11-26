<?php
namespace Darktec\Tests;

use Darktec\Util\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase {

    public function testCreateCollection() {
        $items = array('Item 1', 'Item 2', 'Item 3');

        $collection = new TestCollection($items);
        $this->assertNotEmpty($collection);


        return $collection;
    }

    /**
     * @depends testCreateCollection
     */
    public function testGetItem(Collection $collection) {
        $item = $collection->get(0);

        $this->assertEquals('Item 1', $item);
    }

    /**
     * @depends testCreateCollection
     */
    public function testLength(Collection $collection) {
        $this->assertEquals(3, $collection->length());
    }

    /**
     * @depends testCreateCollection
     */
    public function testAddItem(Collection $collection) {
        $collection->add('Item 4');
        $this->assertEquals(4, $collection->length());

        return $collection;
    }

    /**
     * @depends testAddItem
     */
    public function testDeleteItem(Collection $collection) {
        $collection->delete(3);
        $this->assertEquals(3, $collection->length());
    }

    /**
     * @depends testCreateCollection
     */
    public function testContainsItem(Collection $collection) {
        $this->assertTrue($collection->contains('Item 1'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testKeys(Collection $collection) {
        $this->assertEquals($collection->keys(), array(0,1,2));
    }

    /**
     * @depends testCreateCollection
     */
    public function testKeyExists(Collection $collection) {
        $this->assertTrue($collection->keyExists(0));
    }

    /**
     * @depends testCreateCollection
     * @expectedException        \Darktec\Error\InvalidKeyException
     * @expectedExceptionMessage Invalid index 10
     */
    public function testInvalidKeyException(Collection $collection) {
        $collection->get(10);
    }
}
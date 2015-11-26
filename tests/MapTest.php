<?php
namespace Darktec\Tests;

use Darktec\Util\Map;

class MapTest extends \PHPUnit_Framework_TestCase {

    public function testCreateCollection() {
        $items = array('Key 1' => 'Value 1', 'Key 2' => 'Value 2', 'Key 3' => 'Value 3');

        $map = new TestMap($items);
        $this->assertNotEmpty($map);


        return $map;
    }

    /**
     * @depends testCreateCollection
     */
    public function testGetItem(Map $map) {
        $item = $map->get('Key 1');

        $this->assertEquals('Value 1', $item);
    }

    /**
     * @depends testCreateCollection
     */
    public function testLength(Map $map) {
        $this->assertEquals(3, $map->length());
    }

    /**
     * @depends testCreateCollection
     */
    public function testAddItem(Map $map) {
        $map->add('Key 4', 'Value4');
        $this->assertEquals(4, $map->length());

        return $map;
    }

    /**
     * @depends testAddItem
     */
    public function testDeleteItem(Map $map) {
        $map->delete('Key 4');
        $this->assertEquals(3, $map->length());
    }

    /**
     * @depends testCreateCollection
     */
    public function testContainsItem(Map $map) {
        $this->assertTrue($map->contains('Value 1'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testKeys(Map $map) {
        $this->assertEquals($map->keys(), array('Key 1', 'Key 2', 'Key 3'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testKeyExists(Map $map) {
        $this->assertTrue($map->keyExists('Key 1'));
    }

    /**
     * @depends testCreateCollection
     * @expectedException        \Darktec\Error\InvalidKeyException
     * @expectedExceptionMessage Invalid index 10
     */
    public function testInvalidKeyException(Map $map) {
        $map->get('10');
    }
}
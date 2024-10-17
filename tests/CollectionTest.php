<?php
namespace Darktec\Tests;

use Darktec\Error\InvalidKeyException;
use Darktec\Util\Collection;
use PHPUnit\Framework\TestCase;

class TestCollection extends Collection
{
    public $items;
}

class CollectionTest extends TestCase
{

    public function testCreateCollection()
    {
        $items = array('Key 1' => 'Value 1', 'Key 2' => 'Value 2', 'Key 3' => 'Value 3');

        $collection = new TestCollection($items);
        $this->assertNotEmpty($collection);

        return $collection;
    }

    /**
     * @depends testCreateCollection
     */
    public function testGetItem(Collection $collection)
    {
        $item = $collection->get('Key 1');

        $this->assertEquals('Value 1', $item);
    }

    /**
     * @depends testCreateCollection
     */
    public function testLength(Collection $collection)
    {
        $this->assertEquals(3, $collection->length());
    }

    /**
     * @depends testCreateCollection
     */
    public function testAddItem(Collection $collection)
    {
        $collection->add('Key 4', 'Value4');
        $this->assertEquals(4, $collection->length());

        return $collection;
    }

    /**
     * @depends testAddItem
     */
    public function testDeleteItem(Collection $collection)
    {
        $collection->delete('Key 4');
        $this->assertEquals(3, $collection->length());
    }

    /**
     * @depends testCreateCollection
     */
    public function testContains(Collection $collection)
    {
        $this->assertTrue($collection->contains('Key 1'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testKeys(Collection $collection)
    {
        $this->assertEquals($collection->keys(), array('Key 1', 'Key 2', 'Key 3'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testAll(Collection $collection)
    {
        $this->assertEquals($collection->all(), array('Key 1' => 'Value 1', 'Key 2' => 'Value 2', 'Key 3' => 'Value 3'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testSearch(Collection $collection)
    {
        $this->assertEquals('Key 1', $collection->search('Value 1'));
    }

    /**
     * @depends testCreateCollection
     */
    public function testCount(Collection $collection)
    {
        $this->assertEquals(3, $collection->count());
    }

    /**
     * @depends testCreateCollection
     */
    public function testUpdateCollection(Collection $collection)
    {
        $collection->add('Key 4', array('sub1', 'sub2'));
        
        $this->assertTrue($collection->contains('Key 4'));
        return $collection;
    }

    /**
     * @depends testUpdateCollection
     */
    public function testToArray(Collection $collection)
    {
        $this->assertEquals($collection->toArray(), array('Key 1' => 'Value 1', 'Key 2' => 'Value 2', 'Key 3' => 'Value 3', 'Key 4' => array('sub1', 'sub2')));
        return $collection;
    }

    /**
     * @depends testToArray
     */
    public function testToJson(Collection $collection)
    {
        $this->assertEquals($collection->toJson(),
            json_encode(array('Key 1' => 'Value 1', 'Key 2' => 'Value 2', 'Key 3' => 'Value 3', 'Key 4' => array('sub1', 'sub2'))));
    }

    /**
     * @depends testCreateCollection
     * @expectedException        \Darktec\Error\InvalidKeyException
     * @expectedExceptionMessage Invalid index 10
     */
    public function testInvalidKeyException(Collection $collection)
    {
        $this->expectException(InvalidKeyException::class);
        $collection->get("10");
    }
}
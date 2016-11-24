<?php
namespace SportTools;

/**
 * Class Collection
 * @package SportTools
 */
class Collection implements \IteratorAggregate, \Countable, \JsonSerializable
{
    /**
     * @var object[]
     */
    private $items = [];

    /**
     * @param object $item
     */
    public function add($item)
    {
        $this->items[] = $item;
    }

    /**
     * @param int $index
     * @throws \OutOfRangeException
     */
    private function validateIndexRange($index)
    {
        $count = $this->count();
        if ($index >= $count || $index < 0) {
            throw new \OutOfRangeException('Index out of range: index = ' . $index . ', count = ' . $count);
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return object
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @param int $index
     * @return object
     */
    public function get($index)
    {
        $this->validateIndexRange($index);

        return $this->items[$index];
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return array
     */
    function jsonSerialize()
    {
        $return = [];
        foreach ($this->getIterator() as $object) {
            $return[] = $object;
        }
        return $return;
    }
}
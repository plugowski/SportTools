<?php
namespace SportTools\Workout;

/**
 * Class Id
 * @package SportTools\Workout
 */
class Id
{
    /**
     * @var int
     */
    private $id;

    /**
     * Id constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
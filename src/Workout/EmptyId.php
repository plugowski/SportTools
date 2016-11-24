<?php
namespace SportTools\Workout;

/**
 * Class EmptyId
 * @package SportTools\Workout
 */
class EmptyId extends Id
{
    /** @noinspection PhpMissingParentConstructorInspection */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return -1;
    }
}
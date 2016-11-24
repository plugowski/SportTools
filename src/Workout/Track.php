<?php
namespace SportTools\Workout;

/**
 * Class Track
 * @package SportTools\Workout
 */
class Track
{
    /**
     * @var TrackPointCollection
     */
    private $points;

    /**
     * @return TrackPointCollection
     */
    public function getPoints(): TrackPointCollection
    {
        return $this->points;
    }

    /**
     * @param TrackPointCollection $points
     */
    public function setPoints(TrackPointCollection $points)
    {
        $this->points = $points;
    }
}
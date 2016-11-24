<?php
namespace SportTools\Workout;

/**
 * Class Workout
 * @package SportTools\Workout
 */
class Workout
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var float
     */
    private $distance;
    /**
     * @var float
     */
    private $duration;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var Track
     */
    private $track;

    /**
     * Workout constructor.
     * @param Id $id
     * @param float $distance
     * @param float $duration
     * @param \DateTime $date
     */
    public function __construct(Id $id, float $distance, float $duration, \DateTime $date)
    {
        $this->id = $id;
        $this->distance = $distance;
        $this->duration = $duration;
        $this->date = $date;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * @param float $duration
     */
    public function setDuration(float $duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return Track
     */
    public function getTrack(): Track
    {
        return $this->track;
    }

    /**
     * @param Track $track
     */
    public function setTrack(Track $track)
    {
        $this->track = $track;
    }

}
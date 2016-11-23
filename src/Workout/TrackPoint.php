<?php
namespace SportTools\Workout;

/**
 * Class TrackPoint
 * @package SportTools\Workout
 */
class TrackPoint
{
    /**
     * @var float
     */
    private $latitude;
    /**
     * @var float
     */
    private $longitude;
    /**
     * @var float
     */
    private $elevation;
    /**
     * @var \DateTime
     */
    private $time;
    /**
     * @var float
     */
    private $distance;
    /**
     * @var float
     */
    private $speed;

    /**
     * @param \DateTime $time
     * @param float $latitude
     * @param float $longitude
     * @param float $distance
     * @param float|null $elevation
     */
    public function __construct(\DateTime $time, float $latitude, float $longitude, float $distance, float $elevation = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->distance = $distance;
        $this->elevation = $elevation;
        $this->time = $time;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getElevation(): float
    {
        return $this->elevation;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }
}
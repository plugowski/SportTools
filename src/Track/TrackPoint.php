<?php
namespace SportTools\Track;

/**
 * Class TrackPoint
 * @package SportTools\Track
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
     * @return float|null
     */
    public function getElevation(): ?float
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
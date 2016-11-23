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
     * @param float|null $elevation
     */
    public function __construct(\DateTime $time, float $latitude, float $longitude, float $elevation = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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
     * @param float $distance
     * @return TrackPoint
     */
    public function setDistance(float $distance): self
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @param TrackPoint $trackPoint
     * @return TrackPoint
     */
    public function addDistance(TrackPoint $trackPoint): self
    {
        $this->distance = round($trackPoint->getDistance() + $this->calculateDistance($trackPoint) / 1000, 3);
        return $this;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     * @return TrackPoint
     */
    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * Measure distance between that and any other TrackPoint
     *
     * @param TrackPoint $trackPoint
     * @return float
     */
    public function calculateDistance(TrackPoint $trackPoint)  : float
    {
        $latFrom = deg2rad($this->getLatitude());
        $lonFrom = deg2rad($this->getLongitude());

        $latTo = deg2rad($trackPoint->getLatitude());
        $lonTo = deg2rad($trackPoint->getLongitude());

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * 6371000; // multiply by earth radius
    }

    /**
     * Calculate speed between two TrackPoints
     *
     * @param TrackPoint $trackPoint
     * @return float
     */
    public function calculateSpeed(TrackPoint $trackPoint)  : float
    {
        $time = $this->getTime()->diff($trackPoint->getTime());
        $seconds = $time->days * 86400 + $time->h * 3600 + $time->i * 60 + $time->s;

        if ($seconds === 0) {
            return 0.0;
        }

        return ($this->calculateDistance($trackPoint) / $seconds) * 3.6;
    }
}
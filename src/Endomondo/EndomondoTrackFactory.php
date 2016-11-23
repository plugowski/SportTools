<?php
namespace SportTools\Endomondo;

use SportTools\Workout\Track;
use SportTools\Workout\TrackPoint;
use SportTools\Workout\TrackPointCollection;

/**
 * Class TrackFactory
 * @package SportTools\Endomondo
 */
class EndomondoTrackFactory
{
    /**
     * @param \stdClass $data
     * @return Track|void
     */
    public static function createFromData(\stdClass $data): Track
    {
        $trackPointCollection = new TrackPointCollection();
        $lastPoint = (new TrackPoint(new \DateTime($data[0]->time), $data[0]->lat, $data[0]->lng, $data[0]->alt))->setDistance(0);
        $startDate = $lastPoint->getTime();

        foreach ($data as $trkpt) {

            $trackPoint = new TrackPoint(new \DateTime($trkpt->time), $trkpt->lat, $trkpt->lng, $trkpt->alt);
            !empty($trkpt->dist) ? $trackPoint->setDistance($trkpt->dist) : $trackPoint->addDistance($lastPoint);
            $trackPoint->setSpeed(!empty($trkpt->speed) ? $trkpt->speed : $trackPoint->calculateSpeed($lastPoint));

//            if (!empty($trkpt->hr)) {
//                $trackPoint->setHr($trkpt->hr);
//            }

            $lastPoint = $trackPoint;
            $trackPointCollection->add($lastPoint);
        }

        $track = new Track($startDate, $lastPoint->getTime());
        $track->setPoints($trackPointCollection);

        return $track;
    }
}
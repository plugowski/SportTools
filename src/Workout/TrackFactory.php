<?php
namespace SportTools\Workout;

/**
 * Class TrackFactory
 * @package SportTools\Workout
 */
class TrackFactory
{
    public static function createFromData($data)
    {
        if (empty($data)) {
            return;
        }

        $trackPointCollection = new TrackPointCollection();
        $startDate = new \DateTime($data[0]->time);
        foreach ($data as $trkpt) {
            $dist = !empty($trkpt->dist) ? $trkpt->dist : -1;
            $trackPointCollection->add(new TrackPoint(new \DateTime($trkpt->time), $trkpt->lat, $trkpt->lng, $dist, $trkpt->alt));
        }
        $endDate = new \DateTime($trkpt->time);

        $track = new Track();
        $track->setPoints($trackPointCollection);

        return $track;
    }
}
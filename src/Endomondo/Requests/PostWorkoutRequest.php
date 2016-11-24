<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Workout\Workout;

/**
 * Class PostWorkoutRequest
 * @package SportTools\Endomondo\Requests
 */
class PostWorkoutRequest
{
    /**
     * @var string
     */
    private $authToken;
    /**
     * @var Workout
     */
    private $workout;

    /**
     * PostWorkoutRequest constructor.
     * @param string $authToken
     * @param Workout $workout
     */
    public function __construct(string $authToken, Workout $workout)
    {
        $this->authToken = $authToken;
        $this->workout = $workout;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @return Workout
     */
    public function getWorkout(): Workout
    {
        return $this->workout;
    }
}
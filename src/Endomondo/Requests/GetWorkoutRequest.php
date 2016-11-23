<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Endomondo\EndomondoApi;

/**
 * Class GetWorkoutRequest
 * @package SportTools\Endomondo\Requests
 */
class GetWorkoutRequest extends WorkoutRequest implements ApiRequest
{
    /**
     * @var int
     */
    private $workoutId;

    /**
     * GetWorkoutRequest constructor.
     * @param string $authToken
     * @param int $workoutId
     */
    public function __construct(string $authToken, int $workoutId)
    {
        parent::__construct($authToken);
        $this->workoutId = $workoutId;
    }

    /**
     * @return int
     */
    public function getWorkoutId(): int
    {
        return $this->workoutId;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return EndomondoApi::API_URL . EndomondoApi::URL_WORKOUT_GET;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'authToken' => $this->getAuthToken(),
            'workoutId' => $this->getWorkoutId(),
            'fields' => implode(',', $this->getFields())
        ];
    }
}
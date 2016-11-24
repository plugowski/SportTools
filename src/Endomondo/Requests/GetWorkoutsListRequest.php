<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Endomondo\EndomondoApi;

/**
 * Class GetWorkoutsListRequest
 * @package SportTools\Endomondo\Requests
 */
class GetWorkoutsListRequest extends WorkoutRequest implements ApiRequest
{
    /**
     * @var int
     */
    private $limit = -1;
    /**
     * @var int
     */
    private $userId = -1;

    /**
     * GetWorkoutsListRequest constructor.
     * @param string $authToken
     * @param int $userId
     */
    public function __construct(string $authToken, int $userId)
    {
        parent::__construct($authToken);
        $this->userId = $userId;
    }

    /**
     * @param int $limit
     * @return $this|WorkoutRequest
     */
    public function setLimit(int $limit): WorkoutRequest
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return EndomondoApi::API_URL . EndomondoApi::URL_WORKOUT_LIST;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'authToken' => $this->getAuthToken(),
            'maxResults' => $this->getLimit(),
            'userId' => $this->getUserId(),
            'fields' => implode(',', $this->getFields()),
//            'before' => '2016-11-05 00:00:00 UTC',
//            'after' => '',
        ];
    }
}
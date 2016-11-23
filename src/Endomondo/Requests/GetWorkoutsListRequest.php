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
     * @var string
     */
    private $authToken;
    /**
     * @var int
     */
    private $results = -1;
    /**
     * @var int
     */
    private $userId = -1;
    /**
     * @var array
     */
    private $fields = [self::FIELD_SIMPLE];

    /**
     * GetWorkoutsListRequest constructor.
     * @param string $authToken
     * @param int $userId
     */
    public function __construct(string $authToken, int $userId)
    {
        $this->authToken = $authToken;
        $this->userId = $userId;
    }

    /**
     * @param string $name
     * @return GetWorkoutsListRequest
     * @throws \Exception
     */
    public function withField(string $name): GetWorkoutsListRequest
    {
        if (!in_array($name, self::ALLOWED_FIELDS)) {
            // todo: nicer exception
            throw new \Exception();
        }
        $this->fields[] = $name;
        return $this;
    }

    /**
     * @param array $fields
     * @return GetWorkoutsListRequest
     */
    public function withFieldsList(array $fields): GetWorkoutsListRequest
    {
        foreach ($fields as $field) {
            $this->withField($field);
        }
        return $this;
    }

    /**
     * @param int $results
     * @return GetWorkoutsListRequest
     */
    public function setResults(int $results): GetWorkoutsListRequest
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
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
    public function getResults(): int
    {
        return $this->results;
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
            'maxResults' => $this->getResults(),
            'userId' => $this->getUserId(),
            'fields' => implode(',', $this->getFields()),
//            'before' => '2016-11-05 00:00:00 UTC',
//            'after' => '',
        ];
    }
}
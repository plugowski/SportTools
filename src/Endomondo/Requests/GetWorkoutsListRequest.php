<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Endomondo\EndomondoApi;

/**
 * Class GetWorkoutsListRequest
 * @package SportTools\Endomondo\Requests
 */
class GetWorkoutsListRequest implements ApiRequest
{
    /**
     * @var string
     */
    private $authToken;
    /**
     * @var int
     */
    private $results = -1;
    private $userId;

    /**
     * GetWorkoutsListRequest constructor.
     * @param string $authToken
     */
    public function __construct(string $authToken)
    {
        $this->authToken = $authToken;
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
//            'fields' => null,
//            'fields' => 'device,simple,basic,motivation,interval,weather,polyline_encoded_small,points,lcp_count,tagged_users,pictures',
            'fields' => 'basic',
            'before' => '',
            'after' => '',
        ];
    }
}
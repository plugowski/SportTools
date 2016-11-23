<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Endomondo\EndomondoApi;

/**
 * Class GetFriendsListRequest
 * @package SportTools\Endomondo\Requests
 */
class GetFriendsListRequest implements ApiRequest
{
    /**
     * @var string
     */
    private $authToken;

    /**
     * GetFriendsListRequest constructor.
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
     * @return string
     */
    public function getEndpoint(): string
    {
        return EndomondoApi::API_URL . EndomondoApi::URL_FRIENDS;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'authToken' => $this->getAuthToken()
        ];
    }
}
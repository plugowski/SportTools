<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Endomondo\EndomondoApi;

/**
 * Class GetProfileInfoRequest
 * @package SportTools\Endomondo\Requests
 */
class GetProfileInfoRequest implements ApiRequest
{
    /**
     * @var string
     */
    private $authToken;
    /**
     * @var int
     */
    private $userId;

    /**
     * GetProfileInfoRequest constructor.
     * @param string $authToken
     * @param int $userId
     */
    public function __construct(string $authToken, int $userId)
    {
        $this->authToken = $authToken;
        $this->userId = $userId;
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
     * @return string
     */
    public function getEndpoint(): string
    {
        return EndomondoApi::API_URL . EndomondoApi::URL_PROFILE_GET;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'authToken' => $this->getAuthToken(),
            'userId' => $this->getUserId()
        ];
    }
}
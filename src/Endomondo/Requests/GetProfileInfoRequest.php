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
     * GetProfileInfoRequest constructor.
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
        return EndomondoApi::API_URL . EndomondoApi::URL_PROFILE_GET;
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
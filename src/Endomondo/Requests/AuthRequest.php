<?php
namespace SportTools\Endomondo\Requests;

use SportTools\Endomondo\EndomondoApi;

/**
 * Class AuthRequest
 * @package SportTools\Endomondo\Requests
 */
class AuthRequest implements ApiRequest
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $deviceUuid;

    /**
     * AuthRequest constructor.
     * @param string $email
     * @param string $password
     * @param string $country
     * @param string $deviceUuid
     */
    public function __construct(string $email, string $password, string $country, string $deviceUuid)
    {
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->deviceUuid = $deviceUuid;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getDeviceUuid(): string
    {
        return $this->deviceUuid;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return EndomondoApi::API_URL . EndomondoApi::URL_AUTH;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'action' => 'PAIR',
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'country' => $this->getCountry(),
            'deviceId' => $this->getDeviceUuid()
        ];
    }
}
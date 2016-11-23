<?php
namespace SportTools\Endomondo;

use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;
use SportTools\Endomondo\Requests\ApiRequest;
use SportTools\Endomondo\Requests\AuthRequest;
use SportTools\Endomondo\Requests\GetFriendsListRequest;
use SportTools\Endomondo\Requests\GetProfileInfoRequest;
use SportTools\Endomondo\Requests\GetWorkoutsListRequest;
use SportTools\Endomondo\Requests\WorkoutRequest;

/**
 * Class EndomondoApi
 * @package SportTools\Endomondo
 */
class EndomondoApi
{
    /**
     * Base URL for Endomondo API
     */
    const API_URL = 'http://api.mobile.endomondo.com/mobile';

    /**
     * Definition of all endpoints available via mobile API
     */
    const URL_AUTH =            '/auth';
    const URL_WORKOUTS =        '/api/workouts';
    const URL_WORKOUT_GET =     '/api/workout/get';
    const URL_WORKOUT_POST =    '/api/workout/post';
    const URL_WORKOUT_LIST =    '/api/workout/list';
    const URL_WORKOUT_CREATE =  '/track';
    const URL_PROFILE_GET =     '/api/profile/account/get';
    const URL_PROFILE_POST =    '/api/profile/account/post';
    const URL_FRIENDS =         '/friends';

    /**
     * Fake device information for API requests
     */
    const DEVICE_COUNTRY = 'US';
    const DEVICE_MODEL = 'iPhone';
    const DEVICE_OS = 'iPhone OS';
    const DEVICE_OS_VERSION = '10_1_1';
    const DEVICE_APP_VERSION = '10.2.6';
    const DEVICE_APP_VARIANT = 'M-Pro';
    const DEVICE_USER_AGENT_PATTERN = 'Mozilla/5.0 ({device}; CPU {device_os} {device_os_version} like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/54.0.2840.91 Mobile/14B100 Safari/602.1';

    const RESPONSE_NOT_FOUND = 'NOT_FOUND';

    /**
     * Mapper reqired to build correct User-Agent header
     */
    const USER_AGENT_MAPPER = [
        '{device}' => self::DEVICE_MODEL,
        '{device_os}' => self:: DEVICE_OS,
        '{device_os_version}' => self::DEVICE_OS_VERSION
    ];

    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $authToken;
    /**
     * @var User
     */
    private $user;

    /**
     * EndomondoApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $email
     * @param string $password
     * @throws \Exception
     */
    public function authorize(string $email, string $password)
    {
        $request = new AuthRequest($email, $password, self::DEVICE_COUNTRY, (string)Uuid::uuid5(Uuid::NAMESPACE_DNS, gethostname()));
        $response = $this->call($request);
        $data = explode(PHP_EOL, $response->getBody()->getContents());

        if (200 !== $response->getStatusCode() || 'OK' !== array_shift($data)) {
            // todo: create nicer Exception
            throw new \Exception();
        }

        parse_str(implode('&', $data), $response);
        $this->authToken = $response['authToken'];
        $this->user = new User($response['userId'], $response['displayName']);
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param int $userId
     * @return \stdClass todo: change to User object
     */
    public function getUserInfo(int $userId)
    {
        $response = $this->call(new GetProfileInfoRequest($this->authToken, $userId));
        return json_decode($response->getBody());
    }

    /**
     * @param int $userId
     * @param int $maxResults
     * @return \stdClass todo: change to WorkoutCollection
     * @throws \Exception
     */
    public function getWorkoutsList(int $userId, int $maxResults = 40)
    {
        // todo: data ranges
        $request = (new GetWorkoutsListRequest($this->authToken, $userId))
            ->withField(WorkoutRequest::FIELD_LCP_COUNT)
            ->withField(WorkoutRequest::FIELD_POLYLINE_ENCODED_SMALL)
            ->setResults($maxResults);

        $response = $this->call($request);

        if (200 !== $response->getStatusCode()) {
            // todo: create nicer Exception
            throw new \Exception();
        }

        return json_decode($response->getBody());
    }

    /**
     * Return full list of friends
     *
     * @return array todo: change to UserCollection
     * @throws \Exception
     */
    public function getFriendsList()
    {
        $response = $this->call(new GetFriendsListRequest($this->authToken));
        $data = explode(PHP_EOL, $response->getBody());

        if (200 !== $response->getStatusCode() || 'OK' !== array_shift($data)) {
            // todo: create nicer Exception
            throw new \Exception();
        }

        // endomondo returns list in CSV format like:
        // userId;FullName;imageId;lastWorkoutDateTime;activityName;isPremium[true/false];
        // https://www.endomondo.com/resources/gfx/picture/<imageId>/full.jpg

        $friendsCollection = [];
        foreach ($data as $friendRaw) {
            if (empty($friendRaw)) {
                continue;
            }
            $friendsCollection[] = explode(';', substr($friendRaw, 0, -1));
        }
        return $friendsCollection;
    }

    /**
     * @return string
     */
    private function getUserAgent()
    {
        return str_replace(
            array_keys(self::USER_AGENT_MAPPER), array_values(self::USER_AGENT_MAPPER), self::DEVICE_USER_AGENT_PATTERN
        );
    }

    /**
     * @param ApiRequest $apiRequest
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function call(ApiRequest $apiRequest)
    {
        $exceptions = false;
        $headers = ['User-Agent' => $this->getUserAgent()];
        $endpoint = $apiRequest->getEndpoint() . '?' . http_build_query($apiRequest->getOptions());
        return $this->client->post($endpoint, compact('headers', 'exceptions'));
    }
}
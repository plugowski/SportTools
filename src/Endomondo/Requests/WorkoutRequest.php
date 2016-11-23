<?php
namespace SportTools\Endomondo\Requests;

/**
 * Class WorkoutRequest
 * @package SportTools\Endomondo\Requests
 */
abstract class WorkoutRequest
{
    const FIELD_BASIC = 'basic';
    const FIELD_DEVICE = 'device';
    const FIELD_FEED = 'feed';
    const FIELD_HR_ZONES = 'hr_zones';
    const FIELD_INTERVAL = 'interval';
    const FIELD_LCP_COUNT = 'lcp_count';
    const FIELD_MOTIVATION = 'motivation';
    const FIELD_PICTURES = 'pictures';
    const FIELD_POINTS = 'points';
    const FIELD_POLYLINE_ENCODED_SMALL = 'polyline_encoded_small';
    const FIELD_SIMPLE = 'simple';
    const FIELD_TAGGED_USERS = 'tagged_users';
    const FIELD_WEATHER = 'weather';

    const ALLOWED_FIELDS = [
        self::FIELD_DEVICE, self::FIELD_SIMPLE, self::FIELD_BASIC, self::FIELD_MOTIVATION, self::FIELD_INTERVAL,
        self::FIELD_WEATHER, self::FIELD_POLYLINE_ENCODED_SMALL, self::FIELD_POINTS, self::FIELD_LCP_COUNT,
        self::FIELD_TAGGED_USERS, self::FIELD_PICTURES, self::FIELD_HR_ZONES, self::FIELD_FEED
    ];
}
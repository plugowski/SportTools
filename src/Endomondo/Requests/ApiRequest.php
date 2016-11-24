<?php
namespace SportTools\Endomondo\Requests;

/**
 * Interface ApiRequest
 * @package SportTools\Endomondo\Requests
 */
interface ApiRequest
{
    /**
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * @return array
     */
    public function getOptions(): array;
}
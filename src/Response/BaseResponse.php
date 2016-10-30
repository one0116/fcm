<?php
namespace ker0x\Fcm\Response;

use GuzzleHttp\Psr7\Response;
use ker0x\Fcm\Response\Exception\InvalidRequestException;
use ker0x\Fcm\Response\Exception\ServerResponseException;
use ker0x\Fcm\Response\Exception\UnauthorizedRequestException;

abstract class BaseResponse
{
    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const ERROR = 'error';
    const MESSAGE_ID = 'message_id';

    /**
     * BaseResponse constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(Response $response)
    {
        $this->isRequestSuccess($response);
        $this->parseResponse(json_decode($response->getBody(), true));
    }

    /**
     * Check the status code of the request.
     *
     * @param \GuzzleHttp\Psr7\Response $response The response of the push.
     * @throws \ker0x\Fcm\Response\Exception\InvalidRequestException
     * @throws \ker0x\Fcm\Response\Exception\ServerResponseException
     * @throws \ker0x\Fcm\Response\Exception\UnauthorizedRequestException
     */
    private function isRequestSuccess(Response $response)
    {
        if ($response->getStatusCode() == 200) {
            return;
        }

        if ($response->getStatusCode() == 400) {
            throw new InvalidRequestException($response);
        }

        if ($response->getStatusCode() == 401) {
            throw new UnauthorizedRequestException($response);
        }

        throw new ServerResponseException($response);
    }

    /**
     * @param array $response
     * @return mixed
     */
    protected abstract function parseResponse(array $response);
}
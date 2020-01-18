<?php

namespace BlockChyp\Exception;

/**
 * Implements functionality common to all BlockChyp SDK exceptions.
 */
abstract class BlockChypException extends \Exception
{
    protected $httpStatus;
    protected $httpBody;
    protected $jsonBody;

    /**
     * Creates a new exception.
     * @param string $message The exception message.
     * @param int|null $httpStatus The HTTP status code.
     * @param string|null $httpBody The raw HTTP response body.
     *
     * @return static
     */
    public static function factory($message, $httpStatus = null, $httpBody = null)
    {
        $instance = new static($message);
        $instance->setHttpStatus($httpStatus);
        $instance->setHttpBody($httpBody);
        $instance->setJsonBody(json_decode($httpBody, true));

        return $instance;
    }

    /**
     * Gets the HTTP status code.
     *
     * @return int|null
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * Sets the HTTP status code.
     *
     * @param int|null $httpStatus
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;
    }

    /**
     * Gets the raw HTTP response body.
     *
     * @return string|null
     */
    public function getHttpBody()
    {
        return $this->httpBody;
    }

    /**
     * Sets the raw HTTP response body.
     *
     * @param string|null $httpBody
     */
    public function setHttpBody($httpBody)
    {
        $this->httpBody = $httpBody;
    }

    /**
     * Gets the HTTP response body JSON.
     *
     * @return mixed|null
     */
    public function getJsonBody()
    {
        return $this->jsonBody;
    }

    /**
     * Sets the HTTP response body JSON.
     *
     * @param mixed|null $jsonBody
     */
    public function setJsonBody($jsonBody)
    {
        $this->jsonBody = $jsonBody;
    }

    /**
     * Returns the string representation of the exception.
     *
     * @return string
     */
    public function __toString()
    {
        if (!is_null($this->jsonBody) && isset($this->jsonBody['error'])) {
            return $this->jsonBody['error'];
        }

        if (!is_null($this->httpStatus)) {
            return 'HTTP status: ' . $this->httpStatus;
        }

        return $this->message;
    }
}

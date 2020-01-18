<?php

namespace BlockChyp\Exception;

/**
 * RequestException is thrown when a request contains invalid parameters.
 *
 * @package BlockChyp\Exception
 */

class RequestException extends BlockChypException
{
    protected $parameterName;

    /**
     * Creates a new exception.
     * @param string $message The exception message.
     * @param int|null $httpStatus The HTTP status code.
     * @param string|null $httpBody The raw HTTP response body.
     * @param string|null $parameterName The name of the invalid parameter.
     *
     * @return RequestException
     */
    public static function factory($message, $httpStatus = null, $httpBody = null, $parameterName = null)
    {
        $instance = parent::factory($message, $httpStatus, $httpBody);
        $instance->setParameterName($parameterName);

        return $instance;
    }

    /**
     * Gets the parameter name that caused the exception.
     *
     * @return int|null
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }

    /**
     * Sets the parameter name that caused the exception.
     *
     * @param int|null $parameterName
     */
    public function setParameterName($parameterName)
    {
        $this->parameterName = $parameterName;
    }
}

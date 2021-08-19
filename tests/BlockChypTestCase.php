<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/TestConfiguration.php');

use BlockChyp\BlockChyp;

class BlockChypTestCase extends TestCase
{
    protected $lastTransactionId;

    protected $lastTransactionRef;

    /**
     * Loads blockchyp test configuration from standard location.
     */
    protected function loadTestConfiguration()
    {
        $configHome = '';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $configHome = getenv('userprofile');
        } else {
            $configHome = getenv('XDG_CONFIG_HOME');
            if (!$configHome) {
                $configHome = getenv('HOME') . '/.config';
            }
        }

        $configHome = $configHome . '/blockchyp/sdk-itest-config.json';

        return json_decode(file_get_contents('/' . $configHome));
    }

    protected function getUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    protected function processTestDelay($testName)
    {
        $testDelay = getenv('BC_TEST_DELAY');

        if ($testDelay) {
            $testDelayInt = intval($testDelay);
            if ($testDelayInt > 0) {
                $request = [];
                $request['test'] = true;
                $request['terminalName'] = 'Test Terminal';
                $request['message'] = 'Running ' . $testName . ' in ' . $testDelay . ' seconds...';
                BlockChyp::message($request);
                sleep($testDelayInt);
            }
        }
    }

    protected function processResponseDelay($request)
    {
        $testDelay = getenv('BC_TEST_DELAY');

        if ($testDelay && isset($request['terminalName'])) {
            $testDelayInt = intval($testDelay) / 2;
            if ($testDelayInt > 0) {
                sleep($testDelayInt);
            }
        }
    }

    protected function logRequest($request)
    {
        echo 'Request: ' . print_r($request, true) . PHP_EOL;
    }

    protected function logResponse($response)
    {
        echo 'Response: ' . print_r($response, true) . PHP_EOL;
    }
}

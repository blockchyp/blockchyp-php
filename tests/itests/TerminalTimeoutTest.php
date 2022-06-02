<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalTimeoutTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalTimeout()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running TerminalTimeoutTest...' . PHP_EOL;
        $this->processTestDelay("TerminalTimeoutTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'timeout' => 1,
            'terminalName' => $config->defaultTerminalName,
            'amount' => '25.15',
            'test' => true,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::charge($request);

            // self::logResponse($response);

            // Response assertions

        } catch (Exception $ex) {

            // exception expected

        }
        $this->processResponseDelay($request);
    }
}

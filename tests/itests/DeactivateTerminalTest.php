<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeactivateTerminalTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeactivateTerminal()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running DeactivateTerminalTest...' . PHP_EOL;        // Set request values
        $request = [
            'terminalId' => $this->getUUID(),
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::deactivateTerminal($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertFalse($response['success']);

        } catch (Exception $ex) {

            // exception expected

        }
        $this->processResponseDelay($request);
    }
}

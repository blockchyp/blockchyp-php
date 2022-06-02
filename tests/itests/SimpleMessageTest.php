<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleMessageTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSimpleMessage()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running SimpleMessageTest...' . PHP_EOL;
        $this->processTestDelay("SimpleMessageTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'test' => true,
            'terminalName' => $config->defaultTerminalName,
            'message' => 'Thank You For Your Business',
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::message($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

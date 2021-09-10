<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimplePingTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSimplePing()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("SimplePingTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'test' => true,
            'terminalName' => '$testTerminal',
        ];

        self::logRequest($request);

        $response = BlockChyp::ping($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

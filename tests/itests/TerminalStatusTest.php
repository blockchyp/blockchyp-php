<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalStatusTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalStatus()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("TerminalStatusTest");

        // Set request values
        $request = [
            'terminalName' => 'Test Terminal',
        ];

        self::logRequest($request);

        $response = BlockChyp::terminalStatus($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertTrue($response['idle']);
        $this->processResponseDelay($request);
    }
}

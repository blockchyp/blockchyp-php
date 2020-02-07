<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalClearTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalClear()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("TerminalClearTest");

        // Set request values
        $request = [
            'test' => true,
            'terminalName' => 'Test Terminal',
        ];

        self::logRequest($request);

        $response = BlockChyp::clear($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

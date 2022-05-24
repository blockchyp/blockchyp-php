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

        $this->processTestDelay("DeactivateTerminalTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'terminalId' => $this->getUUID(),
        ];

        self::logRequest($request);

        $response = BlockChyp::deactivateTerminal($request);

        self::logResponse($response);

        // Response assertions
        $this->assertFalse($response['success']);
        $this->processResponseDelay($request);
    }
}

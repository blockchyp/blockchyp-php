<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalGiftCardBalanceTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalGiftCardBalance()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("TerminalGiftCardBalanceTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'test' => true,
            'terminalName' => $config->defaultTerminalName,
        ];

        self::logRequest($request);

        $response = BlockChyp::balance($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertNotEmpty($response['remainingBalance']);
        $this->processResponseDelay($request);
    }
}

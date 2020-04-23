<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalChargeTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalCharge()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("TerminalChargeTest");

        // Set request values
        $request = [
            'terminalName' => 'Test Terminal',
            'amount' => '25.15',
            'test' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::charge($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertTrue($response['approved']);
        $this->assertTrue($response['test']);

        $this->assertEquals(6, strlen($response['authCode']));
        $this->assertNotEmpty($response['transactionId']);
        $this->assertNotEmpty($response['timestamp']);
        $this->assertNotEmpty($response['tickBlock']);

        $this->assertEquals('approved', $response['responseDescription']);
        $this->assertNotEmpty($response['paymentType']);
        $this->assertNotEmpty($response['maskedPan']);
        $this->assertNotEmpty($response['entryMethod']);

        $this->assertEquals('25.15', $response['authorizedAmount']);
        $this->processResponseDelay($request);
    }
}

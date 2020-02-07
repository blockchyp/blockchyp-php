<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleGiftActivateTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSimpleGiftActivate()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("SimpleGiftActivateTest");

        // Set request values
        $request = [
            'test' => true,
            'terminalName' => 'Test Terminal',
            'amount' => '50.00',
        ];

        self::logRequest($request);

        $response = BlockChyp::giftActivate($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertTrue($response['approved']);
        $this->assertNotEmpty($response['publicKey']);
        $this->processResponseDelay($request);
    }
}

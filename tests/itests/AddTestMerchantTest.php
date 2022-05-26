<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class AddTestMerchantTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testAddTestMerchant()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("AddTestMerchantTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'dbaName' => 'Test Merchant',
            'companyName' => 'Test Merchant',
        ];

        self::logRequest($request);

        $response = BlockChyp::addTestMerchant($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);

        $this->assertEquals('Test Merchant', $response['dbaName']);

        $this->assertEquals('Test Merchant', $response['companyName']);
        $this->assertTrue($response['visa']);
        $this->processResponseDelay($request);
    }
}

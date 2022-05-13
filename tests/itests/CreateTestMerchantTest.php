<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class CreateTestMerchantTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testCreateTestMerchant()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("CreateTestMerchantTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'dbaName' => 'Test Merchant',
            'companyName' => 'Test Merchant',
        ];

        self::logRequest($request);

        $response = BlockChyp::createTestMerchant($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UpdateMerchantPlatformsTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUpdateMerchantPlatforms()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("UpdateMerchantPlatformsTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'dbaName' => 'Test Merchant',
            'companyName' => 'Test Merchant',
        ];

        self::logRequest($request);

        $response = BlockChyp::addTestMerchant($request);

        self::logResponse($response);

        if (!empty($response['transactionId'])) {
            $lastTransactionId = $response['transactionId'];
        }
        if (!empty($response['transactionRef'])) {
            $lastTransactionRef = $response['transactionRef'];
        }
        if (!empty($response['customer'])) {
            $lastCustomer = $response['customer'];
        }
        if (!empty($response['token'])) {
            $lastToken = $response['token'];
        }
        if (!empty($response['linkCode'])) {
            $lastLinkCode = $response['linkCode'];
        }

        // Set request values
        $request = [
            'merchantId' => ,
            'platformCode' => 'SIM',
            'notes' => 'platform simulator',
        ];

        self::logRequest($request);

        $response = BlockChyp::updateMerchantPlatforms($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

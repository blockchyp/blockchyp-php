<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleCaptureTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSimpleCapture()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("SimpleCaptureTest");

        // Set request values
        $request = [
            'pan' => '4111111111111111',
            'expMonth' => '12',
            'expYear' => '2025',
            'amount' => '25.55',
            'test' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::preauth($request);

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

        // Set request values
        $request = [
            'transactionId' => $lastTransactionId,
            'test' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::capture($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertTrue($response['approved']);
        $this->processResponseDelay($request);
    }
}

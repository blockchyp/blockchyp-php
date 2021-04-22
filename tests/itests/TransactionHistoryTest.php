<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TransactionHistoryTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTransactionHistory()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("TransactionHistoryTest");

        // Set request values
        $request = [
            'pan' => '4111111111111111',
            'expMonth' => '12',
            'expYear' => '2025',
            'amount' => '25.55',
            'test' => true,
            'transactionRef' => $this->getUUID(),
        ];

        self::logRequest($request);

        $response = BlockChyp::charge($request);

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
            'maxResults' => 10,
        ];

        self::logRequest($request);

        $response = BlockChyp::transactionHistory($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

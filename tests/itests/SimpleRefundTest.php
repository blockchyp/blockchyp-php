<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleRefundTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSimpleRefund()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("SimpleRefundTest");

        // Set request values
        $request = [
            'pan' => '4111111111111111',
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

        // Set request values
        $request = [
            'transactionId' => $lastTransactionId,
            'test' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::refund($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertTrue($response['approved']);
        $this->processResponseDelay($request);
    }
}

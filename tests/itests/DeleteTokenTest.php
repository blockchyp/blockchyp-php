<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeleteTokenTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeleteToken()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("DeleteTokenTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'pan' => '4111111111111111',
            'test' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::enroll($request);

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

        // Set request values
        $request = [
            'token' => $lastToken,
        ];

        self::logRequest($request);

        $response = BlockChyp::deleteToken($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

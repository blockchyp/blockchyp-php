<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class LinkTokenTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testLinkToken()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("LinkTokenTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'pan' => '4111111111111111',
            'test' => true,
            'customer' => [
                'customerRef' => 'TESTCUSTOMER',
                'firstName' => 'Test',
                'lastName' => 'Customer',
            ],
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
        if (!empty($response['linkCode'])) {
            $lastLinkCode = $response['linkCode'];
        }

        // Set request values
        $request = [
            'token' => $lastToken,
            'customerId' => $lastCustomer['id'],
        ];

        self::logRequest($request);

        $response = BlockChyp::linkToken($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

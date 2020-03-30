<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SearchCustomerTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSearchCustomer()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("SearchCustomerTest");

        // Set request values
        $request = [
            'customer' => [
                'firstName' => 'Test',
                'lastName' => 'Customer',
                'companyName' => 'Test Company',
                'emailAddress' => 'support@blockchyp.com',
                'smsNumber' => '(123) 123-1234',
            ],
        ];

        self::logRequest($request);

        $response = BlockChyp::updateCustomer($request);

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
            'query' => '123123',
        ];

        self::logRequest($request);

        $response = BlockChyp::customerSearch($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

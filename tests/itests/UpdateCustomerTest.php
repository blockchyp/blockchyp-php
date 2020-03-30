<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UpdateCustomerTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUpdateCustomer()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("UpdateCustomerTest");

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

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

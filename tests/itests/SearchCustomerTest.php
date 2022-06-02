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
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running SearchCustomerTest...' . PHP_EOL;

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

        // self::logRequest($request);

        $response = BlockChyp::updateCustomer($request);

        // self::logResponse($response);

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
            'query' => '123123',
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::customerSearch($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

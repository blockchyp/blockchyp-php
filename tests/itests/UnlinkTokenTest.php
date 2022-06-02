<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UnlinkTokenTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUnlinkToken()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running UnlinkTokenTest...' . PHP_EOL;

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

        // self::logRequest($request);

        $response = BlockChyp::enroll($request);

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
            'token' => $lastToken,
            'customerId' => $lastCustomer['id'],
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::unlinkToken($request);

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

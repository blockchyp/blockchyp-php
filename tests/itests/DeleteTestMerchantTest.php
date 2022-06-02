<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeleteTestMerchantTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeleteTestMerchant()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running DeleteTestMerchantTest...' . PHP_EOL;
        $profile = $config->profiles->partner;
        if (!empty($profile)) {
            BlockChyp::setApiKey($profile->apiKey);
            BlockChyp::setBearerToken($profile->bearerToken);
            BlockChyp::setSigningKey($profile->signingKey);
        }


        // Set request values
        $request = [
            'dbaName' => 'Test Merchant',
            'companyName' => 'Test Merchant',
        ];

        // self::logRequest($request);

        $response = BlockChyp::addTestMerchant($request);

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
            'merchantId' => $response['merchantId'],
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::deleteTestMerchant($request);

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

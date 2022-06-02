<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class AddTestMerchantTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testAddTestMerchant()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running AddTestMerchantTest...' . PHP_EOL;
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

         try {

            $response = BlockChyp::addTestMerchant($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertEquals('Test Merchant', $response['dbaName']);
    
            $this->assertEquals('Test Merchant', $response['companyName']);
    
            $this->assertTrue($response['visa']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

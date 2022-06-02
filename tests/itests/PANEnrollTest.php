<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class PANEnrollTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testPANEnroll()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running PANEnrollTest...' . PHP_EOL;
        $this->processTestDelay("PANEnrollTest", $config->defaultTerminalName);
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

         try {

            $response = BlockChyp::enroll($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertTrue($response['approved']);
    
            $this->assertTrue($response['test']);
    
            $this->assertEquals(6, strlen($response['authCode']));
    
            $this->assertNotEmpty($response['transactionId']);
    
            $this->assertNotEmpty($response['timestamp']);
    
            $this->assertNotEmpty($response['tickBlock']);
    
            $this->assertEquals('approved', $response['responseDescription']);
    
            $this->assertNotEmpty($response['paymentType']);
    
            $this->assertNotEmpty($response['maskedPan']);
    
            $this->assertNotEmpty($response['entryMethod']);
    
            $this->assertEquals('KEYED', $response['entryMethod']);
    
            $this->assertNotEmpty($response['token']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

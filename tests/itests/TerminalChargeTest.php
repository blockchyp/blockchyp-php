<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalChargeTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalCharge()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running TerminalChargeTest...' . PHP_EOL;
        $this->processTestDelay("TerminalChargeTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'terminalName' => $config->defaultTerminalName,
            'amount' => '25.15',
            'test' => true,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::charge($request);

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
    
            $this->assertEquals('25.15', $response['authorizedAmount']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

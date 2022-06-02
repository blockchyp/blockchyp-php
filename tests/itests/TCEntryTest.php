<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TCEntryTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTCEntry()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running TCEntryTest...' . PHP_EOL;

        // Set request values
        $request = [
        ];

        // self::logRequest($request);

        $response = BlockChyp::tcLog($request);

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
            'logEntryId' => $response['results'][0]['id'],
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::tcEntry($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertNotEmpty($response['id']);
    
            $this->assertNotEmpty($response['terminalId']);
    
            $this->assertNotEmpty($response['terminalName']);
    
            $this->assertNotEmpty($response['timestamp']);
    
            $this->assertNotEmpty($response['name']);
    
            $this->assertNotEmpty($response['content']);
    
            $this->assertTrue($response['hasSignature']);
    
            $this->assertNotEmpty($response['signature']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

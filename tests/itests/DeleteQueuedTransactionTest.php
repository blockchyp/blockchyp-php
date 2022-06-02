<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeleteQueuedTransactionTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeleteQueuedTransaction()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running DeleteQueuedTransactionTest...' . PHP_EOL;
        $this->processTestDelay("DeleteQueuedTransactionTest", $config->defaultTerminalName);


        // Set request values
        $request = [
            'terminalName' => $config->defaultTerminalName,
            'transactionRef' => $this->getUUID(),
            'description' => '1060 West Addison',
            'amount' => '25.15',
            'test' => true,
            'queue' => true,
        ];

        // self::logRequest($request);

        $response = BlockChyp::charge($request);

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
            'terminalName' => $config->defaultTerminalName,
            'transactionRef' => '*',
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::deleteQueuedTransaction($request);

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

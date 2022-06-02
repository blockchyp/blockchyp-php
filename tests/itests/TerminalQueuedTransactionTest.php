<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalQueuedTransactionTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalQueuedTransaction()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running TerminalQueuedTransactionTest...' . PHP_EOL;
        $this->processTestDelay("TerminalQueuedTransactionTest", $config->defaultTerminalName);
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

         try {

            $response = BlockChyp::charge($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertFalse($response['approved']);
    
            $this->assertEquals('Queued', $response['responseDescription']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

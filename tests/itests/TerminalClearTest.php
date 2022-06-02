<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalClearTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTerminalClear()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running TerminalClearTest...' . PHP_EOL;
        $this->processTestDelay("TerminalClearTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'test' => true,
            'terminalName' => $config->defaultTerminalName,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::clear($request);

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

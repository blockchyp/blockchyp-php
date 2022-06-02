<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class CaptureSignatureTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testCaptureSignature()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running CaptureSignatureTest...' . PHP_EOL;
        $this->processTestDelay("CaptureSignatureTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'terminalName' => $config->defaultTerminalName,
            'sigFormat' => BlockChyp::SIGNATURE_FORMAT_PNG,
            'sigWidth' => 200,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::captureSignature($request);

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

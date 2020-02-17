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

        $this->processTestDelay("CaptureSignatureTest");

        // Set request values
        $request = [
            'terminalName' => 'Test Terminal',
            'sigFormat' => BlockChyp::SIGNATURE_FORMAT_PNG,
            'sigWidth' => 200,
        ];

        self::logRequest($request);

        $response = BlockChyp::captureSignature($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

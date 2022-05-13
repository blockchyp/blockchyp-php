<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class GetMerchantsTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testGetMerchants()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("GetMerchantsTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'test' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::getMerchants($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

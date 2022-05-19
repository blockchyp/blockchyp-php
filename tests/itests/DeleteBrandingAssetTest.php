<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeleteBrandingAssetTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeleteBrandingAsset()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("DeleteBrandingAssetTest", $config->defaultTerminalName);

        // Set request values
        $request = [
        ];

        self::logRequest($request);

        $response = BlockChyp::deleteBrandingAsset($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

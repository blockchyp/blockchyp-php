<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UpdateBrandingAssetTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUpdateBrandingAsset()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("UpdateBrandingAssetTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'fileName' => 'aviato.png',
            'fileSize' => 18843,
            'uploadId' => $this->getUUID(),
        ];

        self::logRequest($request);

        $response = BlockChyp::uploadMedia($request);

        self::logResponse($response);

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
            'mediaId' => ,
            'padded' => true,
            'ordinal' => 10,
            'startDate' => '01/06/2021',
            'startTime' => '14:00',
            'endDate' => '11/05/2024',
            'endTime' => '16:00',
            'notes' => 'Test Branding Asset',
            'preview' => false,
            'enabled' => true,
        ];

        self::logRequest($request);

        $response = BlockChyp::updateBrandingAsset($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

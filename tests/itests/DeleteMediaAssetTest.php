<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeleteMediaAssetTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeleteMediaAsset()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running DeleteMediaAssetTest...' . PHP_EOL;

        // Set request values
        $request = [
            'fileName' => 'aviato.png',
            'fileSize' => 18843,
            'uploadId' => $this->getUUID(),
        ];

        // self::logRequest($request);

        $file = file_get_contents('./tests/itests/testdata/aviato.png');
        $response = BlockChyp::uploadMedia($request, $file);

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
            'mediaId' => $response['id'],
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::deleteMediaAsset($request);

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

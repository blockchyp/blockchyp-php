<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UpdateSlideShowTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUpdateSlideShow()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("UpdateSlideShowTest", $config->defaultTerminalName);

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
            'name' => 'Test Slide Show',
            'delay' => 5,
            'slides' => [
                [
                    'mediaId' => ,
                ],
            ],
        ];

        self::logRequest($request);

        $response = BlockChyp::updateSlideShow($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);

        $this->assertEquals('Test Slide Show', $response['name']);
        $this->processResponseDelay($request);
    }
}

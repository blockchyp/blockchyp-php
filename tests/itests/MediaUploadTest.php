<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class MediaUploadTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testMediaUpload()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("MediaUploadTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'fileName' => 'aviato.png',
            'fileSize' => 18843,
            'uploadId' => $this->getUUID(),
        ];

        self::logRequest($request);

        $response = BlockChyp::uploadMedia($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertNotEmpty($response['id']);

        $this->assertEquals('aviato.png', $response['originalFile']);
        $this->assertNotEmpty($response['fileUrl']);
        $this->assertNotEmpty($response['thumbnailUrl']);
        $this->processResponseDelay($request);
    }
}

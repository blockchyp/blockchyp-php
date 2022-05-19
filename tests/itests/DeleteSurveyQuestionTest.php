<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class DeleteSurveyQuestionTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testDeleteSurveyQuestion()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("DeleteSurveyQuestionTest", $config->defaultTerminalName);

        // Set request values
        $request = [
        ];

        self::logRequest($request);

        $response = BlockChyp::deleteSurveyQuestion($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

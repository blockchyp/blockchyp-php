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
            'ordinal' => 1,
            'questionText' => 'Would you shop here again?',
            'questionType' => 'yes_no',
        ];

        self::logRequest($request);

        $response = BlockChyp::updateSurveyQuestion($request);

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
            'questionId' => ,
        ];

        self::logRequest($request);

        $response = BlockChyp::deleteSurveyQuestion($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

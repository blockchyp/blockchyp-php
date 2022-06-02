<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UpdateSurveyQuestionTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUpdateSurveyQuestion()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running UpdateSurveyQuestionTest...' . PHP_EOL;        // Set request values
        $request = [
            'ordinal' => 1,
            'questionText' => 'Would you shop here again?',
            'questionType' => 'yes_no',
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::updateSurveyQuestion($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertEquals('Would you shop here again?', $response['questionText']);
    
            $this->assertEquals('yes_no', $response['questionType']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

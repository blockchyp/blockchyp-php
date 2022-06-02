<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TextPromptTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testTextPrompt()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running TextPromptTest...' . PHP_EOL;
        $this->processTestDelay("TextPromptTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'test' => true,
            'terminalName' => $config->defaultTerminalName,
            'promptType' => BlockChyp::PROMPT_TYPE_EMAIL,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::textPrompt($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertNotEmpty($response['response']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class BooleanPromptTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testBooleanPrompt()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("BooleanPromptTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'test' => true,
            'terminalName' => $config->defaultTerminalName,
            'prompt' => 'Would you like to become a member?',
            'yesCaption' => 'Yes',
            'noCaption' => 'No',
        ];

        self::logRequest($request);

        $response = BlockChyp::booleanPrompt($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->assertTrue($response['response']);
        $this->processResponseDelay($request);
    }
}

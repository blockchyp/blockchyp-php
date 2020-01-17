<?php

namespace BlockChyp;

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

    $this->processTestDelay("TextPromptTest");

    // Set request values
    $request = [
      'test' => TRUE,
      'terminalName' => 'Test Terminal',
      'promptType' => BlockChyp::PROMPT_TYPE_EMAIL,
    ];

    self::logRequest($request);

    $response = BlockChyp::textPrompt($request);

    self::logResponse($response);

    // Response assertions
    $this->assertTrue($response['success']);
    $this->assertNotEmpty($response['response']);
  }

}

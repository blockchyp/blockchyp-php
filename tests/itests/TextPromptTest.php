<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TextPromptTest extends BlockChypTestCase
{

  public function testTextPrompt()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);



  // setup request object
  $request = [];
  $request["test"] = true;
  $request["terminalName"] = "Test Terminal";
  $request["promptType"] = BlockChyp::PROMPT_TYPE_EMAIL;
  self::logRequest($request);
  $response = BlockChyp::textPrompt($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->success);
    $this->assertNotEmpty($response->response);

  }


}

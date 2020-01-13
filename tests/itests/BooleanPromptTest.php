<?php

namespace BlockChyp;

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

    $this->processTestDelay("BooleanPromptTest");

    // setup request object
    $request = [];
    $request['test'] = true;
    $request['terminalName'] = 'Test Terminal';
    $request['prompt'] = 'Would you like to become a member?';
    $request['yesCaption'] = 'Yes';
    $request['noCaption'] = 'No';

    self::logRequest($request);

    $response = BlockChyp::booleanPrompt($request);

    self::logResponse($response);

    // response assertions
    $this->assertTrue($response['success']);
    $this->assertTrue($response['response']);
  }


}

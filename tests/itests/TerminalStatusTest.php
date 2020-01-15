<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalStatusTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testTerminalStatus()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("TerminalStatusTest");

    // setup request object
    $request = [];
    $request['terminalName'] = 'Test Terminal';

    self::logRequest($request);

    $response = BlockChyp::terminalStatus($request);

    self::logResponse($response);

    // response assertions
    $this->assertTrue($response['success']);
    $this->assertTrue($response['idle']);
  }


}

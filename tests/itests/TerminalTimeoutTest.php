<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalTimeoutTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testTerminalTimeout()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("TerminalTimeoutTest");

    // setup request object
    $request = [];
    $request['timeout'] = 1;
    $request['terminalName'] = 'Test Terminal';
    $request['amount'] = '25.15';
    $request['test'] = true;

    self::logRequest($request);

    $this->expectException(\BlockChyp\Exception\ConnectionException::class);
    $response = BlockChyp::charge($request);

    self::logResponse($response);
  }


}

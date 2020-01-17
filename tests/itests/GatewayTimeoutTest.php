<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class GatewayTimeoutTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testGatewayTimeout()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("GatewayTimeoutTest");

    // Set request values
    $request = [
      'timeout' => 1,
      'pan' => '5555555555554444',
      'amount' => '25.55',
      'test' => TRUE,
      'transactionRef' => $this->getUUID(),
    ];

    self::logRequest($request);

    $this->expectException(\BlockChyp\Exception\ConnectionException::class);
    $response = BlockChyp::charge($request);

    self::logResponse($response);
  }

}

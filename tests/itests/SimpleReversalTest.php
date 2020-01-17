<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleReversalTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testSimpleReversal()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("SimpleReversalTest");

    // Set request values
    $request = [
      'pan' => '4111111111111111',
      'amount' => '25.55',
      'test' => TRUE,
      'transactionRef' => $this->getUUID(),
    ];

    self::logRequest($request);

    $response = BlockChyp::reverse($request);

    self::logResponse($response);

    if (!empty($response['transactionId'])) {
      $lastTransactionId = $response['transactionId'];
    }
    if (!empty($response['transactionRef'])) {
      $lastTransactionRef = $response['transactionRef'];
    }

    // Set request values
    $request = [
      'transactionRef' => $lastTransactionRef,
      'test' => TRUE,
    ];

    self::logRequest($request);

    $response = BlockChyp::reverse($request);

    self::logResponse($response);

    // Response assertions
    $this->assertTrue($response['approved']);
  }

}

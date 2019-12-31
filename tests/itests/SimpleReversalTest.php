<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleReversalTest extends BlockChypTestCase
{

  public function testSimpleReversal()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("SimpleReversalTest");


    // setup request object
    $request = [];
  $request["pan"] = "4111111111111111";
  $request["amount"] = "25.55";
  $request["test"] = true;
  $request["transactionRef"] = $this->getUUID();
    self::logRequest($request);
    $response = BlockChyp::charge($request);
    self::logResponse($response);
    if ($response["transactionId"]) {
      $lastTransactionId = $response["transactionId"];
    }
    if ($response["transactionRef"]) {
      $lastTransactionRef = $response["transactionRef"];
    }



  // setup request object
  $request = [];
  $request["transactionRef"] = $lastTransactionRef;
  $request["test"] = true;
  self::logRequest($request);
  $response = BlockChyp::reverse($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response["approved"]);

  }


}

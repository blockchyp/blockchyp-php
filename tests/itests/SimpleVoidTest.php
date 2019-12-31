<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleVoidTest extends BlockChypTestCase
{

  public function testSimpleVoid()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);


    // setup request object
    $request = [];
  $request["pan"] = "4111111111111111";
  $request["amount"] = "25.55";
  $request["test"] = true;
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
  $request["transactionId"] = $lastTransactionId;
  $request["test"] = true;
  self::logRequest($request);
  $response = BlockChyp::void($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->approved);

  }


}

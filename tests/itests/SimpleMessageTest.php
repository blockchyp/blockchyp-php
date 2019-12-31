<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleMessageTest extends BlockChypTestCase
{

  public function testSimpleMessage()
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
  $request["message"] = "Thank You For Your Business";
  self::logRequest($request);
  $response = BlockChyp::message($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->success);

  }


}

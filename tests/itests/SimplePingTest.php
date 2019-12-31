<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimplePingTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testSimplePing()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("SimplePingTest");



  // setup request object
  $request = [];
  $request["test"] = true;
  $request["terminalName"] = "Test Terminal";
  self::logRequest($request);
  $response = BlockChyp::ping($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response["success"]);

  }


}

<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleBatchCloseTest extends BlockChypTestCase
{

  public function testSimpleBatchClose()
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
  self::logRequest($request);
  $response = BlockChyp::closeBatch($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->success);
    $this->assertNotEmpty($response->capturedTotal);
    $this->assertNotEmpty($response->openPreauths);

  }


}

<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SimpleGiftActivateTest extends BlockChypTestCase
{

  public function testSimpleGiftActivate()
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
  $request["amount"] = "50.00";
  self::logRequest($request);
  $response = BlockChyp::giftActivate($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->approved);
    $this->assertNotEmpty($response->publicKey);

  }


}

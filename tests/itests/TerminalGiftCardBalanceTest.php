<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalGiftCardBalanceTest extends BlockChypTestCase
{

  public function testTerminalGiftCardBalance()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("TerminalGiftCardBalanceTest");



  // setup request object
  $request = [];
  $request["test"] = true;
  $request["terminalName"] = "Test Terminal";
  self::logRequest($request);
  $response = BlockChyp::balance($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response["success"]);
    $this->assertNotEmpty($response["remainingBalance"]);

  }


}

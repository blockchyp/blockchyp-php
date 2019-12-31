<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalPreauthTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testTerminalPreauth()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("TerminalPreauthTest");



  // setup request object
  $request = [];
  $request["terminalName"] = "Test Terminal";
  $request["amount"] = "15.15";
  $request["test"] = true;
  self::logRequest($request);
  $response = BlockChyp::preauth($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response["approved"]);
    $this->assertTrue($response["test"]);
    $this->assertEquals(6, strlen($response["authCode"]));
    $this->assertNotEmpty($response["transactionId"]);
    $this->assertNotEmpty($response["timestamp"]);
    $this->assertNotEmpty($response["tickBlock"]);
    $this->assertEquals("Approved", $response["responseDescription"]);
    $this->assertNotEmpty($response["paymentType"]);
    $this->assertNotEmpty($response["maskedPan"]);
    $this->assertNotEmpty($response["entryMethod"]);
    $this->assertEquals("15.15", $response["authorizedAmount"]);

  }


}

<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalEnrollTest extends BlockChypTestCase
{

  public function testTerminalEnroll()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);



  // setup request object
  $request = [];
  $request["terminalName"] = "Test Terminal";
  $request["test"] = true;
  self::logRequest($request);
  $response = BlockChyp::enroll($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->approved);
    $this->assertTrue($response->test);
    $this->assertEquals(6, strlen($response->authCode));
    $this->assertNotEmpty($response->transactionId);
    $this->assertNotEmpty($response->timestamp);
    $this->assertNotEmpty($response->tickBlock);
    $this->assertEquals("Approved", $response->responseDescription);
    $this->assertNotEmpty($response->paymentType);
    $this->assertNotEmpty($response->maskedPan);
    $this->assertNotEmpty($response->entryMethod);
    $this->assertNotEmpty($response->token);

  }


}

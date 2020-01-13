<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TerminalManualEBTChargeTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testTerminalManualEBTCharge()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("TerminalManualEBTChargeTest");

    // setup request object
    $request = [];
    $request['terminalName'] = 'Test Terminal';
    $request['amount'] = '27.00';
    $request['test'] = true;
    $request['cardType'] = BlockChyp::CARD_TYPE_EBT;
    $request['manualEntry'] = true;

    self::logRequest($request);

    $response = BlockChyp::charge($request);

    self::logResponse($response);

    // response assertions
    $this->assertTrue($response['approved']);
    $this->assertTrue($response['test']);
    $this->assertEquals(6, strlen($response['authCode']));
    $this->assertNotEmpty($response['transactionId']);
    $this->assertNotEmpty($response['timestamp']);
    $this->assertNotEmpty($response['tickBlock']);
    $this->assertEquals('Approved', $response['responseDescription']);
    $this->assertNotEmpty($response['paymentType']);
    $this->assertNotEmpty($response['maskedPan']);
    $this->assertNotEmpty($response['entryMethod']);
    $this->assertEquals('27.00', $response['authorizedAmount']);
    $this->assertEquals('73.00', $response['remainingBalance']);
  }


}

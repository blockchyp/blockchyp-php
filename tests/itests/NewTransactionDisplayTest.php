<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class NewTransactionDisplayTest extends BlockChypTestCase
{

  public function testNewTransactionDisplay()
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
  $request["transaction"] = $this->newTransactionDisplayTransaction();
  self::logRequest($request);
  $response = BlockChyp::newTransactionDisplay($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response->success);

  }

  private function newTransactionDisplayTransaction() {
    $val = [];
    $val["subtotal"] = "35.00";
    $val["tax"] = "5.00";
    $val["total"] = "70.00";
    $val["items"] = $this->newTransactionDisplayItems();
    return $val;
  }
  private function newTransactionDisplayItems() {
    $val = [];
    array_push($val, $this->newTransactionDisplayItem2());
    return $val;
  }
  private function newTransactionDisplayItem2() {
    $val = [];
    $val["description"] = "Leki Trekking Poles";
    $val["price"] = "35.00";
    $val["quantity"] = 2;
    $val["extended"] = "70.00";
    $val["discounts"] = $this->newTransactionDisplayDiscounts();
    return $val;
  }
  private function newTransactionDisplayDiscounts() {
    $val = [];
    array_push($val, $this->newTransactionDisplayDiscount2());
    return $val;
  }
  private function newTransactionDisplayDiscount2() {
    $val = [];
    $val["description"] = "memberDiscount";
    $val["amount"] = "10.00";
    return $val;
  }

}

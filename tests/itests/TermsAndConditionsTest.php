<?php

namespace BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class TermsAndConditionsTest extends BlockChypTestCase
{

  /**
   * @group itest
   */
  public function testTermsAndConditions()
  {

    $config = $this->loadTestConfiguration();

    BlockChyp::setApiKey($config->apiKey);
    BlockChyp::setBearerToken($config->bearerToken);
    BlockChyp::setSigningKey($config->signingKey);
    BlockChyp::setGatewayHost($config->gatewayHost);
    BlockChyp::setTestGatewayHost($config->testGatewayHost);

    $this->processTestDelay("TermsAndConditionsTest");



  // setup request object
  $request = [];
  $request["test"] = true;
  $request["terminalName"] = "Test Terminal";
  $request["tcName"] = "HIPPA Disclosure";
  $request["tcContent"] = "Full contract text";
  $request["sigFormat"] = BlockChyp::SIGNATURE_FORMAT_PNG;
  $request["sigWidth"] = 200;
  $request["sigRequired"] = true;
  self::logRequest($request);
  $response = BlockChyp::termsAndConditions($request);
  self::logResponse($response);


    // response assertions
    $this->assertTrue($response["success"]);

  }


}

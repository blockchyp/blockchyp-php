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
    $request["tcContent"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ullamcorper id urna quis pulvinar. Pellentesque vestibulum justo ac nulla consectetur tristique. Suspendisse arcu arcu, viverra vel luctus non, dapibus vitae augue. Aenean ac volutpat purus. Curabitur in lacus nisi. Nam vel sagittis eros. Curabitur faucibus ut nisl in pulvinar. Nunc egestas, orci ut porttitor tempus, ante mauris pellentesque ex, nec feugiat purus arcu ac metus. Cras sodales ornare lobortis. Aenean lacinia ultricies purus quis pharetra. Cras vestibulum nulla et magna eleifend eleifend. Nunc nibh dolor, malesuada ut suscipit vitae, bibendum quis dolor. Phasellus ultricies ex vitae dolor malesuada, vel dignissim neque accumsan.";
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

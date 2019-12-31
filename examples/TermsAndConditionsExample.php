<?php
  // for composer based systems
  require_once('vendor/autoload.php');

  // for manual installation
  #require_once('/path/to/blockchyp/init.php');

  \BlockChyp\BlockChyp::setApiKey("SPBXTSDAQVFFX5MGQMUMIRINVI");
  \BlockChyp\BlockChyp::setBearerToken("7BXBTBUPSL3BP7I6Z2CFU6H3WQ");
  \BlockChyp\BlockChyp::setSigningKey("bcae3708938cb8004ab1278e6c0fcd68f9d815e1c3c86228d028242b147af58e");

  // setup request object
  $request = [];
  $request["test"] = true;
  $request["terminalName"] = "Test Terminal";
  // Alias for a T&C template configured in blockchyp.
  $request["tcAlias"] = "hippa";
  // Name of the contract or document if not using an alias.
  $request["tcName"] = "HIPPA Disclosure";
  // Full text of the contract or disclosure if not using an alias.
  $request["tcContent"] = "Full contract text";
  // File format for the signature image.
  $request["sigFormat"] = BlockChyp::SIGNATURE_FORMAT_PNG;
  // Width of the signature image in pixels.
  $request["sigWidth"] = 200;
  // Whether or not a signature is required. Defaults to true.
  $request["sigRequired"] = true;

  $response = \BlockChyp\BlockChyp::termsAndConditions($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

  echo $response["sig"] . PHP_EOL;
  echo $response["sigFile"] . PHP_EOL;
?>

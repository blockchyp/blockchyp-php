<?php
  // for composer based systems
  require_once('vendor/autoload.php');

  // for manual installation
  #require_once('/path/to/blockchyp/init.php');

  \BlockChyp\BlockChyp::setApiKey(getenv('BC_API_KEY'));
  \BlockChyp\BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
  \BlockChyp\BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

  // setup request object
  $request = [];
  $request['test'] = true;
  $request['terminalName'] = 'Test Terminal';
  // Alias for a Terms and Conditions template configured in the BlockChyp
  // dashboard.
  $request['tcAlias'] = 'hippa';
  // Name of the contract or document if not using an alias.
  $request['tcName'] = 'HIPPA Disclosure';
  // Full text of the contract or disclosure if not using an alias.
  $request['tcContent'] = 'Full contract text';
  // File format for the signature image.
  $request['sigFormat'] = BlockChyp::SIGNATURE_FORMAT_PNG;
  // Width of the signature image in pixels.
  $request['sigWidth'] = 200;
  // Whether or not a signature is required. Defaults to true.
  $request['sigRequired'] = true;

  $response = \BlockChyp\BlockChyp::termsAndConditions($request);

  // view the result
  echo 'Response: ' . print_r($response, TRUE) . PHP_EOL;

?>

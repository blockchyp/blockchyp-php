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
  $request['transactionId'] = '<PREAUTH TRANSACTION ID>';

  $response = \BlockChyp\BlockChyp::capture($request);

  // view the result
  echo 'Response: ' . print_r($response, TRUE) . PHP_EOL;

?>

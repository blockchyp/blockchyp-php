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
  $request['terminalName'] = 'Test Terminal';
  $request['transactionId'] = '<PREVIOUS TRANSACTION ID>';
  // Optional amount for partial refunds.
  $request['amount'] = '5.00';

  $response = \BlockChyp\BlockChyp::refund($request);

  // view the result
  echo 'Response: ' . print_r($response, TRUE) . PHP_EOL;

?>

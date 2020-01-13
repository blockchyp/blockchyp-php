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
  $request['terminalName'] = 'Test Terminal';
  $request['transactionId'] = '<PREVIOUS TRANSACTION ID>';
  // Optional amount for partial refunds.
  $request['amount'] = '5.00';

  $response = \BlockChyp\BlockChyp::refund($request);

  //process the result
  if ($response['approved']) {
    echo 'Approved' . PHP_EOL;
  }

?>

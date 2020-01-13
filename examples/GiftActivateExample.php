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
  $request['test'] = true;
  $request['terminalName'] = 'Test Terminal';
  $request['amount'] = '50.00';

  $response = \BlockChyp\BlockChyp::giftActivate($request);

  //process the result
  if ($response['approved']) {
    echo 'Approved' . PHP_EOL;
  }

  echo $response['amount'] . PHP_EOL;
  echo $response['currentBalance'] . PHP_EOL;
  echo $response['publicKey'] . PHP_EOL;
?>

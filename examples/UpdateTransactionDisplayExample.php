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
  $request['transaction'] = newTransactionDisplayTransaction();

  $response = \BlockChyp\BlockChyp::updateTransactionDisplay($request);

  // view the result
  echo 'Response: ' . print_r($response, TRUE) . PHP_EOL;

  function newTransactionDisplayTransaction() {
    $val = [];
    $val['subtotal'] = '60.00';
    $val['tax'] = '5.00';
    $val['total'] = '65.00';
    $val['items'] = newTransactionDisplayItems();
    return $val;
  }
  function newTransactionDisplayItems() {
    $val = [];
    array_push($val, newTransactionDisplayItem2());
    return $val;
  }
  function newTransactionDisplayItem2() {
    $val = [];
    $val['description'] = 'Leki Trekking Poles';
    $val['price'] = '35.00';
    $val['quantity'] = 2;
    $val['extended'] = '70.00';
    $val['discounts'] = newTransactionDisplayDiscounts();
    return $val;
  }
  function newTransactionDisplayDiscounts() {
    $val = [];
    array_push($val, newTransactionDisplayDiscount2());
    return $val;
  }
  function newTransactionDisplayDiscount2() {
    $val = [];
    $val['description'] = 'memberDiscount';
    $val['amount'] = '10.00';
    return $val;
  }
?>

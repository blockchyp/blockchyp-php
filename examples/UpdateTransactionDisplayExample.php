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
  $request["transaction"] = newTransactionDisplayTransaction();

  $response = \BlockChyp\BlockChyp::updateTransactionDisplay($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

  function newTransactionDisplayTransaction() {
    $val = [];
    $val["subtotal"] = "60.00";
    $val["tax"] = "5.00";
    $val["total"] = "65.00";
    $val["items"] = newTransactionDisplayItems();
    return $val;
  }
  function newTransactionDisplayItems() {
    $val = [];
    array_push($val, newTransactionDisplayItem2());
    return $val;
  }
  function newTransactionDisplayItem2() {
    $val = [];
    $val["description"] = "Leki Trekking Poles";
    $val["price"] = "35.00";
    $val["quantity"] = 2;
    $val["extended"] = "70.00";
    $val["discounts"] = newTransactionDisplayDiscounts();
    return $val;
  }
  function newTransactionDisplayDiscounts() {
    $val = [];
    array_push($val, newTransactionDisplayDiscount2());
    return $val;
  }
  function newTransactionDisplayDiscount2() {
    $val = [];
    $val["description"] = "memberDiscount";
    $val["amount"] = "10.00";
    return $val;
  }
?>

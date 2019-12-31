# BlockChyp PHP SDK


## Getting a Developer Kit

In order to test your integration with real terminals, you'll need a BlockChyp
Developer Kit.  Our kits include a fully functioning payment terminal with
test pin encryption keys.  Every kit includes a comprehensive set of test
cards with test cards for every major card brand and entry method, including
Contactless and Contact EMV and mag stripe cards.  Each kit also includes
test gift cards for our blockchain gift card system.

Access to BlockChyp's developer program is currently invite only, but you
can request an invitation by contacting our engineering team at **nerds@blockchyp.com**.

You can also view a number of long form demos and learn more about us on our [YouTube Channel](https://www.youtube.com/channel/UCE-iIVlJic_XArs_U65ZcJg).

## Transaction Code Examples

You don't want to read words. You want examples. Here's a quick rundown of the
stuff you can do with the BlockChyp PHP SDK and a few basic examples.
#### Charge

Executes a standard direct preauth and capture.

```php
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
  $request["amount"] = "55.00";

  $response = \BlockChyp\BlockChyp::charge($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

  echo $response["authCode"] . PHP_EOL;
  echo $response["authorizedAmount"] . PHP_EOL;
?>


```
#### Preauthorization

Executes a preauthorization intended to be captured later.

```php
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
  $request["amount"] = "27.00";

  $response = \BlockChyp\BlockChyp::preauth($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

  echo $response["authCode"] . PHP_EOL;
  echo $response["authorizedAmount"] . PHP_EOL;
?>


```
#### Terminal Ping

Tests connectivity with a payment terminal.

```php
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
  $request["terminalName"] = "Test Terminal";

  $response = \BlockChyp\BlockChyp::ping($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

?>


```
#### Balance

Checks the remaining balance on a payment method.

```php
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
  $request["cardType"] = BlockChyp::CARD_TYPE_EBT;

  $response = \BlockChyp\BlockChyp::balance($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

?>


```
#### Terminal Clear

Clears the line item display and any in progress transaction.

```php
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

  $response = \BlockChyp\BlockChyp::clear($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

?>


```
#### Terms & Conditions Capture

Prompts the user to accept terms and conditions.

```php
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


```
#### Update Transaction Display

Appends items to an existing transaction display Subtotal, Tax, and Total are
overwritten by the request. Items with the same description are combined into
groups.

```php
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
    echo "Succeded" . PHP_EOL;
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


```
#### New Transaction Display

Displays a new transaction on the terminal.

```php
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

  $response = \BlockChyp\BlockChyp::newTransactionDisplay($request);

  //process the result
  if ($response["success"]) {
    echo "Succeded" . PHP_EOL;
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


```
#### Text Prompt

Asks the consumer text based question.

```php
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
  // Type of prompt. Can be 'email', 'phone', 'customer-number', or
  // 'rewards-number'.
  $request["promptType"] = BlockChyp::PROMPT_TYPE_EMAIL;

  $response = \BlockChyp\BlockChyp::textPrompt($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

  echo $response["response"] . PHP_EOL;
?>


```
#### Boolean Prompt

Asks the consumer a yes/no question.

```php
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
  $request["prompt"] = "Would you like to become a member?";
  $request["yesCaption"] = "Yes";
  $request["noCaption"] = "No";

  $response = \BlockChyp\BlockChyp::booleanPrompt($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

  echo $response["response"] . PHP_EOL;
?>


```
#### Display Message

Displays a short message on the terminal.

```php
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
  $request["message"] = "Thank you for your business.";

  $response = \BlockChyp\BlockChyp::message($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

?>


```
#### Refund

Executes a refund.

```php
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
  $request["terminalName"] = "Test Terminal";
  $request["transactionId"] = "<PREVIOUS TRANSACTION ID>";
  // Optional amount for partial refunds.
  $request["amount"] = "5.00";

  $response = \BlockChyp\BlockChyp::refund($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

?>


```
#### Enroll

Adds a new payment method to the token vault.

```php
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

  $response = \BlockChyp\BlockChyp::enroll($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

  echo $response["token"] . PHP_EOL;
?>


```
#### Gift Card Activation

Activates or recharges a gift card.

```php
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
  $request["amount"] = "50.00";

  $response = \BlockChyp\BlockChyp::giftActivate($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

  echo $response["amount"] . PHP_EOL;
  echo $response["currentBalance"] . PHP_EOL;
  echo $response["publicKey"] . PHP_EOL;
?>


```
#### Time Out Reversal

Executes a manual time out reversal.

We love time out reversals. Don't be afraid to use them whenever a request to a
BlockChyp terminal times out. You have up to two minutes to reverse any
transaction. The only caveat is that you must assign transactionRef values when
you build the original request. Otherwise, we have no real way of knowing which
transaction you're trying to reverse because we may not have assigned it an id
yet. And if we did assign it an id, you wouldn't know what it is because your
request to the terminal timed out before you got a response.

```php
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
  $request["terminalName"] = "Test Terminal";
  $request["transactionRef"] = "<LAST TRANSACTION REF>";

  $response = \BlockChyp\BlockChyp::reverse($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

?>


```
#### Capture Preauthorization

Captures a preauthorization.

```php
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
  $request["transactionId"] = "<PREAUTH TRANSACTION ID>";

  $response = \BlockChyp\BlockChyp::capture($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

?>


```
#### Close Batch

Closes the current credit card batch.

```php
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

  $response = \BlockChyp\BlockChyp::closeBatch($request);

  //process the result
  if ($response["success"]) {
    echo "Success" . PHP_EOL;
  }

  echo $response["capturedTotal"] . PHP_EOL;
  echo $response["openPreauths"] . PHP_EOL;
?>


```
#### Void Transaction

Discards a previous preauth transaction.

```php
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
  $request["transactionId"] = "<PREVIOUS TRANSACTION ID>";

  $response = \BlockChyp\BlockChyp::void($request);

  //process the result
  if ($response["approved"]) {
    echo "Approved" . PHP_EOL;
  }

?>


```

## Running Integration Tests

We recommend using composer to run integration tests.  Ensure all dependencies
have been downloaded into the vendor diretory by running `composer install`.

You can then use the following command to run an integration test:

`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/itests/TerminalChargeTest`


## Contributions

BlockChyp welcomes contributions from the open source community, but bear in mind
that this repository has been generated by our internal SDK Generator tool.  If
we choose to accept a PR or contribution, your code will be moved into our SDK
Generator project, which is a private repository.

## License

Copyright BlockChyp, Inc., 2019

Distributed under the terms of the [MIT] license, blockchyp-php is free and open source software.

[MIT]: https://github.com/blockchyp/blockchyp-php/blob/master/LICENSE

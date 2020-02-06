# BlockChyp PHP SDK

[![Build Status](https://circleci.com/gh/blockchyp/blockchyp-php/tree/master.svg?style=shield)](https://circleci.com/gh/blockchyp/blockchyp-php/tree/master)
[![Packagist](https://img.shields.io/packagist/v/blockchyp/blockchyp-php)](https://packagist.org/packages/blockchyp/blockchyp-php)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/blockchyp/blockchyp-php/blob/master/LICENSE)

This is the SDK for PHP. Like all BlockChyp SDKs, it provides a full
client for the BlockChyp gateway and BlockChyp payment terminals.

## Installation

The preferred method of installing BlockChyp is via composer. Type the following
command from your project's root directory to add BlockChyp to your composer.json file.

```
composer require blockchyp/blockchyp-php
```

## Public Facing Web Pages

If you're using PHP, there's a good chance your front end is a web page. This SDK
is great for communicating with terminals and the BlockChyp gateway, but is not
sufficient on its own for dealing with e-commerce scenarios.

For e-commerce, consider supplementing the SDK with our
[Web Tokenizer](https://github.com/blockchyp/blockchyp-tokenizer). It's
a pure JavaScript library that allows you to tokenize e-commerce payments via a
cross-origin iframe. This keeps you out of PCI scope. Check it out on
[GitHub](https://github.com/blockchyp/blockchyp-tokenizer).

## A Simple Example

Running your first transaction is easy. Make sure you have a BlockChyp terminal,
activate it, and generate a set of API keys. The sample code below show how
to run a basic terminal transaction.

```
<?php
  require_once('vendor/autoload.php');

  use \BlockChyp\BlockChyp;

  BlockChyp::setApiKey('SPBXTSDAQVFFX5MGQMUMIRINVI');
  BlockChyp::setBearerToken('7BXBTBUPSL3BP7I6Z2CFU6H3WQ');
  BlockChyp::setSigningKey('bcae3708938cb8004ab1278e6c0fcd68f9d815e1c3c86228d028242b147af58e');

  $request = [
    'test' => TRUE,
    'terminalName' => 'Test Terminal',
    'amount' => '55.00',
  ];

  $response = BlockChyp::charge($request);

  echo 'Response: ' . print_r($response, TRUE) . PHP_EOL;
```


## The Rest APIs

All BlockChyp SDKs provide a convenient way of accessing the BlockChyp REST APIs.
You can checkout the REST API documentation via the links below.

[Terminal REST API Docs](https://docs.blockchyp.com/rest-api/terminal/index.html)

[Gateway REST API Docs](https://docs.blockchyp.com/rest-api/gateway/index.html)

## Other SDKs

BlockChyp has officially supported SDKs for eight different development platforms and counting.
Here's the full list with links to their GitHub repositories.

[Go SDK](https://github.com/blockchyp/blockchyp-go)

[Node.js/JavaScript SDK](https://github.com/blockchyp/blockchyp-js)

[Java SDK](https://github.com/blockchyp/blockchyp-java)

[.net/C# SDK](https://github.com/blockchyp/blockchyp-csharp)

[Ruby SDK](https://github.com/blockchyp/blockchyp-ruby)

[PHP SDK](https://github.com/blockchyp/blockchyp-php)

[Python SDK](https://github.com/blockchyp/blockchyp-python)

[iOS (Objective-C/Swift) SDK](https://github.com/blockchyp/blockchyp-ios)

## Getting a Developer Kit

In order to test your integration with real terminals, you'll need a BlockChyp
Developer Kit. Our kits include a fully functioning payment terminal with
test pin encryption keys. Every kit includes a comprehensive set of test
cards with test cards for every major card brand and entry method, including
Contactless and Contact EMV and mag stripe cards. Each kit also includes
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
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'amount' => '55.00',
];

$response = BlockChyp::charge($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Preauthorization

Executes a preauthorization intended to be captured later.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'amount' => '27.00',
];

$response = BlockChyp::preauth($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Terminal Ping

Tests connectivity with a payment terminal.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'terminalName' => 'Test Terminal',
];

$response = BlockChyp::ping($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Balance

Checks the remaining balance on a payment method.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'cardType' => BlockChyp::CARD_TYPE_EBT,
];

$response = BlockChyp::balance($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Terminal Clear

Clears the line item display and any in progress transaction.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
];

$response = BlockChyp::clear($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Terms & Conditions Capture

Prompts the user to accept terms and conditions.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',

    // Alias for a Terms and Conditions template configured in the BlockChyp
    // dashboard.
    'tcAlias' => 'hippa',

    // Name of the contract or document if not using an alias.
    'tcName' => 'HIPPA Disclosure',

    // Full text of the contract or disclosure if not using an alias.
    'tcContent' => 'Full contract text',

    // File format for the signature image.
    'sigFormat' => BlockChyp::SIGNATURE_FORMAT_PNG,

    // Width of the signature image in pixels.
    'sigWidth' => 200,

    // Whether or not a signature is required. Defaults to true.
    'sigRequired' => true,
];

$response = BlockChyp::termsAndConditions($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Update Transaction Display

Appends items to an existing transaction display.  Subtotal, Tax, and Total are
overwritten by the request. Items with the same description are combined into
groups.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'transaction' => [
        'subtotal' => '60.00',
        'tax' => '5.00',
        'total' => '65.00',
        'items' => [
            [
                'description' => 'Leki Trekking Poles',
                'price' => '35.00',
                'quantity' => 2,
                'extended' => '70.00',
                'discounts' => [
                    [
                        'description' => 'memberDiscount',
                        'amount' => '10.00',
                    ],
                ],
            ],
        ],
    ],
];

$response = BlockChyp::updateTransactionDisplay($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### New Transaction Display

Displays a new transaction on the terminal.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'transaction' => [
        'subtotal' => '60.00',
        'tax' => '5.00',
        'total' => '65.00',
        'items' => [
            [
                'description' => 'Leki Trekking Poles',
                'price' => '35.00',
                'quantity' => 2,
                'extended' => '70.00',
                'discounts' => [
                    [
                        'description' => 'memberDiscount',
                        'amount' => '10.00',
                    ],
                ],
            ],
        ],
    ],
];

$response = BlockChyp::newTransactionDisplay($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Text Prompt

Asks the consumer a text based question.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',

    // Type of prompt. Can be 'email', 'phone', 'customer-number', or
    // 'rewards-number'.
    'promptType' => BlockChyp::PROMPT_TYPE_EMAIL,
];

$response = BlockChyp::textPrompt($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Boolean Prompt

Asks the consumer a yes/no question.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'prompt' => 'Would you like to become a member?',
    'yesCaption' => 'Yes',
    'noCaption' => 'No',
];

$response = BlockChyp::booleanPrompt($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Display Message

Displays a short message on the terminal.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'message' => 'Thank you for your business.',
];

$response = BlockChyp::message($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Refund

Executes a refund.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'terminalName' => 'Test Terminal',
    'transactionId' => '<PREVIOUS TRANSACTION ID>',

    // Optional amount for partial refunds.
    'amount' => '5.00',
];

$response = BlockChyp::refund($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Enroll

Adds a new payment method to the token vault.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
];

$response = BlockChyp::enroll($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Gift Card Activation

Activates or recharges a gift card.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'terminalName' => 'Test Terminal',
    'amount' => '50.00',
];

$response = BlockChyp::giftActivate($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

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
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'terminalName' => 'Test Terminal',
    'transactionRef' => '<LAST TRANSACTION REF>',
];

$response = BlockChyp::reverse($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Capture Preauthorization

Captures a preauthorization.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'transactionId' => '<PREAUTH TRANSACTION ID>',
];

$response = BlockChyp::capture($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Close Batch

Closes the current credit card batch.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
];

$response = BlockChyp::closeBatch($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Void Transaction

Discards a previous preauth transaction.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'test' => true,
    'transactionId' => '<PREVIOUS TRANSACTION ID>',
];

$response = BlockChyp::void($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

#### Terminal Status

Returns the current status of a terminal.


```php
<?php
// For composer based systems
require_once('vendor/autoload.php');

// For manual installation
#require_once('/path/to/blockchyp/init.php');

use BlockChyp\BlockChyp;

BlockChyp::setApiKey(getenv('BC_API_KEY'));
BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

// Populate request values
$request = [
    'terminalName' => 'Test Terminal',
];

$response = BlockChyp::terminalStatus($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

```

## Running Integration Tests

If you'd like to run the integration tests, create a new file on your system
called `sdk-itest-config.json` with the API credentials you'll be using as
shown in the example below.

```
{
 "gatewayHost": "https://api.blockchyp.com",
 "testGatewayHost": "https://test.blockchyp.com",
 "apiKey": "PZZNEFK7HFULCB3HTLA7HRQDJU",
 "bearerToken": "QUJCHIKNXOMSPGQ4QLT2UJX5DI",
 "signingKey": "f88a72d8bc0965f193abc7006bbffa240663c10e4d1dc3ba2f81e0ca10d359f5"
}
```

This file can be located in a few different places, but is usually located
at `<USER_HOME>/.config/blockchyp/sdk-itest-config.json`. All BlockChyp SDKs
use the same configuration file.

To run the integration test suite via `make`, type the following command:

`make integration`


## Running Integration Tests Via Composer

If you'd like to bypass make and run the integration test suite directly,
use the following command:

`BC_TEST_DELAY=5 ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/itests`

You can run individual tests by adding the test name to the previous command. The
following example runs the TerminalChargeTest:

`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/itests/TerminalChargeTest`

## Contributions

BlockChyp welcomes contributions from the open source community, but bear in mind
that this repository has been generated by our internal SDK Generator tool. If
we choose to accept a PR or contribution, your code will be moved into our SDK
Generator project, which is a private repository.

## License

Copyright BlockChyp, Inc., 2019

Distributed under the terms of the [MIT] license, blockchyp-php is free and open source software.

[MIT]: https://github.com/blockchyp/blockchyp-php/blob/master/LICENSE

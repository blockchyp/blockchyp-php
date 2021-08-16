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
    'amount' => '199.99',
    'description' => 'Widget',
    'subject' => 'Widget invoice',
    'transaction' => [
        'subtotal' => '195.00',
        'tax' => '4.99',
        'total' => '199.99',
        'items' => [
            [
                'description' => 'Widget',
                'price' => '195.00',
                'quantity' => 1,
            ],
        ],
    ],
    'autoSend' => true,
    'customer' => [
        'customerRef' => 'Customer reference string',
        'firstName' => 'FirstName',
        'lastName' => 'LastName',
        'companyName' => 'Company Name',
        'emailAddress' => 'support@blockchyp.com',
        'smsNumber' => '(123) 123-1231',
    ],
];

$response = BlockChyp::sendPaymentLink($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

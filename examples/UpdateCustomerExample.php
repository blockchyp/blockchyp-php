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
    'customer' => [
        'id' => 'ID of the customer to update',
        'customerRef' => 'Customer reference string',
        'firstName' => 'FirstName',
        'lastName' => 'LastName',
        'companyName' => 'Company Name',
        'emailAddress' => 'support@blockchyp.com',
        'smsNumber' => '(123) 123-1231',
    ],
];

$response = BlockChyp::updateCustomer($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

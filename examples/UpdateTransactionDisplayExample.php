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

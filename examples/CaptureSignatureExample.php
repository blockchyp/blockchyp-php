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

    // File format for the signature image.
    'sigFormat' => BlockChyp::SIGNATURE_FORMAT_PNG,

    // Width of the signature image in pixels.
    'sigWidth' => 200,
];

$response = BlockChyp::captureSignature($request);

// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

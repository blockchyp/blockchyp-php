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

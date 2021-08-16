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

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
    'mediaId' => '<MEDIA ID>',
    'padded' => true,
    'ordinal' => 10,
    'startDate' => '01/06/2021',
    'startTime' => '14:00',
    'endDate' => '11/05/2024',
    'endTime' => '16:00',
    'notes' => 'Test Branding Asset',
    'preview' => false,
    'enabled' => true,
];


$response = BlockChyp::updateBrandingAsset($request);


// View the result
echo 'Response: ' . print_r($response, true) . PHP_EOL;

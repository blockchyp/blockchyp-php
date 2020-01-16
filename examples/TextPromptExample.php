<?php
  // for composer based systems
  require_once('vendor/autoload.php');

  // for manual installation
  #require_once('/path/to/blockchyp/init.php');

  \BlockChyp\BlockChyp::setApiKey(getenv('BC_API_KEY'));
  \BlockChyp\BlockChyp::setBearerToken(getenv('BC_BEARER_TOKEN'));
  \BlockChyp\BlockChyp::setSigningKey(getenv('BC_SIGNING_KEY'));

  // setup request object
  $request = [];
  $request['test'] = true;
  $request['terminalName'] = 'Test Terminal';
  // Type of prompt. Can be 'email', 'phone', 'customer-number', or
  // 'rewards-number'.
  $request['promptType'] = BlockChyp::PROMPT_TYPE_EMAIL;

  $response = \BlockChyp\BlockChyp::textPrompt($request);

  // view the result
  echo 'Response: ' . print_r($response, TRUE) . PHP_EOL;

?>

<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class NewTransactionDisplayTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testNewTransactionDisplay()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running NewTransactionDisplayTest...' . PHP_EOL;
        $this->processTestDelay("NewTransactionDisplayTest", $config->defaultTerminalName);
             // Set request values
        $request = [
            'test' => true,
            'terminalName' => $config->defaultTerminalName,
            'transaction' => [
                'subtotal' => '35.00',
                'tax' => '5.00',
                'total' => '70.00',
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

        // self::logRequest($request);

         try {

            $response = BlockChyp::newTransactionDisplay($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

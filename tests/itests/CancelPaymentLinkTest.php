<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class CancelPaymentLinkTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testCancelPaymentLink()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("CancelPaymentLinkTest", $config->defaultTerminalName);

        // Set request values
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

        self::logRequest($request);

        $response = BlockChyp::sendPaymentLink($request);

        self::logResponse($response);

        if (!empty($response['transactionId'])) {
            $lastTransactionId = $response['transactionId'];
        }
        if (!empty($response['transactionRef'])) {
            $lastTransactionRef = $response['transactionRef'];
        }
        if (!empty($response['customer'])) {
            $lastCustomer = $response['customer'];
        }
        if (!empty($response['token'])) {
            $lastToken = $response['token'];
        }
        if (!empty($response['linkCode'])) {
            $lastLinkCode = $response['linkCode'];
        }

        // Set request values
        $request = [
            'linkCode' => $lastLinkCode,
        ];

        self::logRequest($request);

        $response = BlockChyp::cancelPaymentLink($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SendPaymentLinkTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSendPaymentLink()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running SendPaymentLinkTest...' . PHP_EOL;        // Set request values
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
                'emailAddress' => 'notifications@blockchypteam.m8r.co',
                'smsNumber' => '(123) 123-1231',
            ],
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::sendPaymentLink($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertNotEmpty($response['url']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

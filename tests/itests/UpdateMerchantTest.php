<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class UpdateMerchantTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testUpdateMerchant()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("UpdateMerchantTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'test' => true,
            'dbaName' => 'Test Merchant',
            'companyName' => 'Test Merchant',
            'billingAddress' => [
                'address1' => '1060 West Addison',
                'city' => 'Chicago',
                'stateOrProvince' => 'IL',
                'postalCode' => '60613',
            ],
        ];

        self::logRequest($request);

        $response = BlockChyp::updateMerchant($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

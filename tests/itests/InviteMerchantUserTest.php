<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class InviteMerchantUserTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testInviteMerchantUser()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $this->processTestDelay("InviteMerchantUserTest", $config->defaultTerminalName);

        // Set request values
        $request = [
            'email' => 'doublea@blockchypteam.m8r.co',
            'firstName' => 'Aaron',
            'lastName' => 'Anderson',
        ];

        self::logRequest($request);

        $response = BlockChyp::inviteMerchantUser($request);

        self::logResponse($response);

        // Response assertions
        $this->assertTrue($response['success']);
        $this->processResponseDelay($request);
    }
}

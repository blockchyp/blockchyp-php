<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class PartnerStatementsTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testPartnerStatements()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running PartnerStatementsTest...' . PHP_EOL;
        $profile = $config->profiles->partner;
        if (!empty($profile)) {
            BlockChyp::setApiKey($profile->apiKey);
            BlockChyp::setBearerToken($profile->bearerToken);
            BlockChyp::setSigningKey($profile->signingKey);
        }
        // Set request values
        $request = [
            'test' => true,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::partnerStatements($request);

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

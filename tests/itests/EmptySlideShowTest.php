<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class EmptySlideShowTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testEmptySlideShow()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running EmptySlideShowTest...' . PHP_EOL;        // Set request values
        $request = [
            'name' => 'Test Slide Show',
            'delay' => 5,
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::updateSlideShow($request);

            // self::logResponse($response);

            // Response assertions
    
            $this->assertTrue($response['success']);
    
            $this->assertEquals('Test Slide Show', $response['name']);

        } catch (Exception $ex) {

            echo $ex->getTraceAsString();
            $this->assertEmpty($ex);

        }
        $this->processResponseDelay($request);
    }
}

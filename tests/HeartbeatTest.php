<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/BlockChypTestCase.php');

class HeartbeatTest extends BlockChypTestCase
{
    public function testHeartbeat(): void
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);

        $response = BlockChyp::heartbeat(true);

        $this->assertTrue($response["success"]);
        $this->assertNotEmpty($response["timestamp"]);
        $this->assertNotEmpty($response["clockchain"]);
        $this->assertNotEmpty($response["latestTick"]);
        $this->assertNotEmpty($response["merchantPk"]);
    }
}

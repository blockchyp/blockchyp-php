<?php

use BlockChyp\BlockChyp;

require_once(__DIR__ . '/../BlockChypTestCase.php');

class SubmitApplicationTest extends BlockChypTestCase
{

    /**
     * @group itest
     */
    public function testSubmitApplication()
    {
        $config = $this->loadTestConfiguration();

        BlockChyp::setApiKey($config->apiKey);
        BlockChyp::setBearerToken($config->bearerToken);
        BlockChyp::setSigningKey($config->signingKey);
        BlockChyp::setGatewayHost($config->gatewayHost);
        BlockChyp::setTestGatewayHost($config->testGatewayHost);
        BlockChyp::setDashboardHost($config->dashboardHost);

        echo 'Running SubmitApplicationTest...' . PHP_EOL;
        $profile = $config->profiles->partner;
        if (!empty($profile)) {
            BlockChyp::setApiKey($profile->apiKey);
            BlockChyp::setBearerToken($profile->bearerToken);
            BlockChyp::setSigningKey($profile->signingKey);
        }
        // Set request values
        $request = [
            'test' => true,
            'inviteCode' => 'asdf',
            'dbaName' => 'BlockChyp',
            'corporateName' => 'BlockChyp Inc.',
            'webSite' => 'https://www.blockchyp.com',
            'taxIdNumber' => '123456789',
            'entityType' => 'CORPORATION',
            'stateOfIncorporation' => 'UT',
            'merchantType' => 'RETAIL',
            'businessDescription' => 'Payment processing solutions',
            'yearsInBusiness' => '5',
            'businessPhoneNumber' => '5555551234',
            'physicalAddress' => [
                'address1' => '355 S 520 W',
                'city' => 'Lindon',
                'stateOrProvince' => 'UT',
                'postalCode' => '84042',
                'countryCode' => 'US',
            ],
            'mailingAddress' => [
                'address1' => '355 S 520 W',
                'city' => 'Lindon',
                'stateOrProvince' => 'UT',
                'postalCode' => '84042',
                'countryCode' => 'US',
            ],
            'contactFirstName' => 'John',
            'contactLastName' => 'Doe',
            'contactPhoneNumber' => '5555555678',
            'contactEmail' => 'john.doe@example.com',
            'contactTitle' => 'CEO',
            'contactTaxIdNumber' => '987654321',
            'contactDOB' => '1980-01-01',
            'contactDlNumber' => 'D1234567',
            'contactDlStateOrProvince' => 'NY',
            'contactDlExpiration' => '2025-12-31',
            'contactHomeAddress' => [
                'address1' => '355 S 520 W',
                'city' => 'Lindon',
                'stateOrProvince' => 'UT',
                'postalCode' => '84042',
                'countryCode' => 'US',
            ],
            'contactRole' => 'OWNER',
            'owners' => [
                [
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'jobTitle' => 'CEO',
                    'taxIdNumber' => '876543210',
                    'phoneNumber' => '5555559876',
                    'dob' => '1981-02-02',
                    'ownership' => '50',
                    'email' => 'john.doe@example.com',
                    'dlNumber' => 'D7654321',
                    'dlStateOrProvince' => 'UT',
                    'dlExpiration' => '2024-12-31',
                    'address' => [
                        'address1' => '355 S 520 W',
                        'city' => 'Lindon',
                        'stateOrProvince' => 'UT',
                        'postalCode' => '84042',
                        'countryCode' => 'US',
                    ],
                ],
            ],
            'manualAccount' => [
                'name' => 'Business Checking',
                'bank' => 'Test Bank',
                'accountHolderName' => 'BlockChyp Inc.',
                'routingNumber' => '124001545',
                'accountNumber' => '987654321',
            ],
            'averageTransaction' => '100.00',
            'highTransaction' => '1000.00',
            'averageMonth' => '10000.00',
            'highMonth' => '20000.00',
            'refundPolicy' => '30_DAYS',
            'refundDays' => '30',
            'timeZone' => 'America/Denver',
            'batchCloseTime' => '23:59',
            'multipleLocations' => 'false',
            'ebtRequested' => 'false',
            'ecommerce' => 'true',
            'cardPresentPercentage' => '70',
            'phoneOrderPercentage' => '10',
            'ecomPercentage' => '20',
            'signerName' => 'John Doe',
        ];

        // self::logRequest($request);

         try {

            $response = BlockChyp::submitApplication($request);

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

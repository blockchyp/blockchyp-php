<?php

namespace BlockChyp;

/**
 * Primary entry point for working with BlockChyp in PHP.
 *
 * @package BlockChyp
 */
class BlockChyp extends BlockChypClient
{

    /**
     * tests connection to the gateway
     */
    public static function heartbeat($test)
    {
        return self::gatewayRequest('GET', '/api/heartbeat', ['test' => $test]);
    }

    /**
     * Tests connectivity with a payment terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function ping($request)
    {
        return self::routeTerminalRequest('POST', '/api/test', '/api/terminal-test', $request);
    }

    /**
     * Executes a standard direct preauth and capture.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function charge($request)
    {
        return self::routeTerminalRequest('POST', '/api/charge', '/api/charge', $request);
    }

    /**
     * Executes a preauthorization intended to be captured later.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function preauth($request)
    {
        return self::routeTerminalRequest('POST', '/api/preauth', '/api/preauth', $request);
    }

    /**
     * Executes a refund.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function refund($request)
    {
        return self::routeTerminalRequest('POST', '/api/refund', '/api/refund', $request);
    }

    /**
     * Adds a new payment method to the token vault.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function enroll($request)
    {
        return self::routeTerminalRequest('POST', '/api/enroll', '/api/enroll', $request);
    }

    /**
     * Activates or recharges a gift card.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function giftActivate($request)
    {
        return self::routeTerminalRequest('POST', '/api/gift-activate', '/api/gift-activate', $request);
    }

    /**
     * Checks the remaining balance on a payment method.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function balance($request)
    {
        return self::routeTerminalRequest('POST', '/api/balance', '/api/balance', $request);
    }

    /**
     * Clears the line item display and any in progress transaction.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function clear($request)
    {
        return self::routeTerminalRequest('POST', '/api/clear', '/api/terminal-clear', $request);
    }

    /**
     * Returns the current status of a terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function terminalStatus($request)
    {
        return self::routeTerminalRequest('POST', '/api/terminal-status', '/api/terminal-status', $request);
    }

    /**
     * Prompts the user to accept terms and conditions.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function termsAndConditions($request)
    {
        return self::routeTerminalRequest('POST', '/api/tc', '/api/terminal-tc', $request);
    }

    /**
     * Captures and returns a signature.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function captureSignature($request)
    {
        return self::routeTerminalRequest('POST', '/api/capture-signature', '/api/capture-signature', $request);
    }

    /**
     * Displays a new transaction on the terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function newTransactionDisplay($request)
    {
        return self::routeTerminalRequest('POST', '/api/txdisplay', '/api/terminal-txdisplay', $request);
    }

    /**
     * Appends items to an existing transaction display. Subtotal, Tax, and Total are
     * overwritten by the request. Items with the same description are combined into
     * groups.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function updateTransactionDisplay($request)
    {
        return self::routeTerminalRequest('PUT', '/api/txdisplay', '/api/terminal-txdisplay', $request);
    }

    /**
     * Displays a short message on the terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function message($request)
    {
        return self::routeTerminalRequest('POST', '/api/message', '/api/message', $request);
    }

    /**
     * Asks the consumer a yes/no question.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function booleanPrompt($request)
    {
        return self::routeTerminalRequest('POST', '/api/boolean-prompt', '/api/boolean-prompt', $request);
    }

    /**
     * Asks the consumer a text based question.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function textPrompt($request)
    {
        return self::routeTerminalRequest('POST', '/api/text-prompt', '/api/text-prompt', $request);
    }

    /**
     * Returns a list of queued transactions on a terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function listQueuedTransactions($request)
    {
        return self::routeTerminalRequest('POST', '/api/queue/list', '/api/queue/list', $request);
    }

    /**
     * Deletes a queued transaction from the terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function deleteQueuedTransaction($request)
    {
        return self::routeTerminalRequest('POST', '/api/queue/delete', '/api/queue/delete', $request);
    }

    /**
     * Reboot a payment terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function reboot($request)
    {
        return self::routeTerminalRequest('POST', '/api/reboot', '/api/terminal-reboot', $request);
    }

    /**
     * Returns routing and location data for a payment terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function locate($request)
    {
        return self::gatewayRequest('POST', '/api/terminal-locate', $request);
    }
    /**
     * Captures a preauthorization.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function capture($request)
    {
        return self::gatewayRequest('POST', '/api/capture', $request);
    }
    /**
     * Discards a previous transaction.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function void($request)
    {
        return self::gatewayRequest('POST', '/api/void', $request);
    }
    /**
     * Executes a manual time out reversal.
     *
     * We love time out reversals. Don't be afraid to use them whenever a request to a
     * BlockChyp terminal times out. You have up to two minutes to reverse any
     * transaction. The only caveat is that you must assign transactionRef values when
     * you build the original request. Otherwise, we have no real way of knowing which
     * transaction you're trying to reverse because we may not have assigned it an id yet.
     * And if we did assign it an id, you wouldn't know what it is because your request to the
     * terminal timed out before you got a response.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function reverse($request)
    {
        return self::gatewayRequest('POST', '/api/reverse', $request);
    }
    /**
     * Closes the current credit card batch.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function closeBatch($request)
    {
        return self::gatewayRequest('POST', '/api/close-batch', $request);
    }
    /**
     * Creates and send a payment link to a customer.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function sendPaymentLink($request)
    {
        return self::gatewayRequest('POST', '/api/send-payment-link', $request);
    }
    /**
     * Resends payment link.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function resendPaymentLink($request)
    {
        return self::gatewayRequest('POST', '/api/resend-payment-link', $request);
    }
    /**
     * Cancels a payment link.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function cancelPaymentLink($request)
    {
        return self::gatewayRequest('POST', '/api/cancel-payment-link', $request);
    }
    /**
     * Retrieves the status of a payment link.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function paymentLinkStatus($request)
    {
        return self::gatewayRequest('POST', '/api/payment-link-status', $request);
    }
    /**
     * Retrieves the current status of a transaction.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function transactionStatus($request)
    {
        return self::gatewayRequest('POST', '/api/tx-status', $request);
    }
    /**
     * Updates or creates a customer record.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function updateCustomer($request)
    {
        return self::gatewayRequest('POST', '/api/update-customer', $request);
    }
    /**
     * Retrieves a customer by id.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function customer($request)
    {
        return self::gatewayRequest('POST', '/api/customer', $request);
    }
    /**
     * Searches the customer database.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function customerSearch($request)
    {
        return self::gatewayRequest('POST', '/api/customer-search', $request);
    }
    /**
     * Calculates the discount for actual cash transactions.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function cashDiscount($request)
    {
        return self::gatewayRequest('POST', '/api/cash-discount', $request);
    }
    /**
     * Returns the batch history for a merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function batchHistory($request)
    {
        return self::gatewayRequest('POST', '/api/batch-history', $request);
    }
    /**
     * Returns the batch details for a single batch.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function batchDetails($request)
    {
        return self::gatewayRequest('POST', '/api/batch-details', $request);
    }
    /**
     * Returns the transaction history for a merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function transactionHistory($request)
    {
        return self::gatewayRequest('POST', '/api/tx-history', $request);
    }
    /**
     * Returns pricing policy for a merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function pricingPolicy($request)
    {
        return self::gatewayRequest('POST', '/api/read-pricing-policy', $request);
    }
    /**
     * Returns a list of partner statements.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function partnerStatements($request)
    {
        return self::gatewayRequest('POST', '/api/partner-statement-list', $request);
    }
    /**
     * Returns detail for a single partner statement.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function partnerStatementDetail($request)
    {
        return self::gatewayRequest('POST', '/api/partner-statement-detail', $request);
    }
    /**
     * Returns a list of merchant invoices.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function merchantInvoices($request)
    {
        return self::gatewayRequest('POST', '/api/merchant-invoice-list', $request);
    }
    /**
     * Returns detail for a single merchant-invoice statement.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function merchantInvoiceDetail($request)
    {
        return self::gatewayRequest('POST', '/api/merchant-invoice-detail', $request);
    }
    /**
     * Returns low level details for how partner commissions were calculated for a
     * specific merchant statement.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function partnerCommissionBreakdown($request)
    {
        return self::gatewayRequest('POST', '/api/partner-commission-breakdown', $request);
    }
    /**
     * Returns profile information for a merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function merchantProfile($request)
    {
        return self::gatewayRequest('POST', '/api/public-merchant-profile', $request);
    }
    /**
     * Deletes a customer record.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function deleteCustomer($request)
    {
        return self::gatewayRequest('DELETE', '/api/customer/' . $request["customerId"], $request);
    }
    /**
     * Retrieves payment token metadata.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function tokenMetadata($request)
    {
        return self::gatewayRequest('GET', '/api/token/' . $request["token"], $request);
    }
    /**
     * Links a token to a customer record.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function linkToken($request)
    {
        return self::gatewayRequest('POST', '/api/link-token', $request);
    }
    /**
     * Removes a link between a customer and a token.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function unlinkToken($request)
    {
        return self::gatewayRequest('POST', '/api/unlink-token', $request);
    }
    /**
     * Deletes a payment token.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */
    public static function deleteToken($request)
    {
        return self::gatewayRequest('DELETE', '/api/token/' . $request["token"], $request);
    }
    /**
     * Generates and returns api credentials for a given merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function merchantCredentialGeneration($request)
    {
        return self::dashboardRequest('POST', '/api/generate-merchant-creds', $request);
    }

    /**
     * Adds a test merchant account.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function getMerchants($request)
    {
        return self::dashboardRequest('POST', '/api/get-merchants', $request);
    }

    /**
     * Adds or updates a merchant account. Can be used to create or update test merchants.
     * Only gateway partners may create new live merchants.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function updateMerchant($request)
    {
        return self::dashboardRequest('POST', '/api/update-merchant', $request);
    }

    /**
     * List all active users and pending invites for a merchant account.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function merchantUsers($request)
    {
        return self::dashboardRequest('POST', '/api/merchant-users', $request);
    }

    /**
     * Invites a user to join a merchant account.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function inviteMerchantUser($request)
    {
        return self::dashboardRequest('POST', '/api/invite-merchant-user', $request);
    }

    /**
     * Adds a test merchant account.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function addTestMerchant($request)
    {
        return self::dashboardRequest('POST', '/api/add-test-merchant', $request);
    }

    /**
     * Deletes a test merchant account. Supports partner scoped API credentials only.
     * Live merchant accounts cannot be deleted.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deleteTestMerchant($request)
    {
        return self::dashboardRequest('DELETE', '/api/test-merchant/' . $request["merchantId"], $request);
    }

    /**
     * List all merchant platforms configured for a gateway merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function merchantPlatforms($request)
    {
        return self::dashboardRequest('GET', '/api/plugin-configs/' . $request["merchantId"], $request);
    }

    /**
     * List all merchant platforms configured for a gateway merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function updateMerchantPlatforms($request)
    {
        return self::dashboardRequest('POST', '/api/plugin-configs', $request);
    }

    /**
     * Deletes a boarding platform configuration.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deleteMerchantPlatforms($request)
    {
        return self::dashboardRequest('DELETE', '/api/plugin-config/' . $request["platformId"], $request);
    }

    /**
     * Returns all terminals associated with the merchant account.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function terminals($request)
    {
        return self::dashboardRequest('GET', '/api/terminals', $request);
    }

    /**
     * Deactivates a terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deactivateTerminal($request)
    {
        return self::dashboardRequest('DELETE', '/api/terminal/' . $request["terminalId"], $request);
    }

    /**
     * Activates a terminal.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function activateTerminal($request)
    {
        return self::dashboardRequest('POST', '/api/terminal-activate', $request);
    }

    /**
     * Returns a list of terms and conditions templates associated with a merchant
     * account.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function tcTemplates($request)
    {
        return self::dashboardRequest('GET', '/api/tc-templates', $request);
    }

    /**
     * Returns a single terms and conditions template.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function tcTemplate($request)
    {
        return self::dashboardRequest('GET', '/api/tc-templates/' . $request["templateId"], $request);
    }

    /**
     * Updates or creates a terms and conditions template.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function tcUpdateTemplate($request)
    {
        return self::dashboardRequest('POST', '/api/tc-templates', $request);
    }

    /**
     * Deletes a single terms and conditions template.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function tcDeleteTemplate($request)
    {
        return self::dashboardRequest('DELETE', '/api/tc-templates/' . $request["templateId"], $request);
    }

    /**
     * Returns up to 250 entries from the Terms and Conditions log.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function tcLog($request)
    {
        return self::dashboardRequest('POST', '/api/tc-log', $request);
    }

    /**
     * Returns a single detailed Terms and Conditions entry.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function tcEntry($request)
    {
        return self::dashboardRequest('GET', '/api/tc-entry/' . $request["logEntryId"], $request);
    }

    /**
     * Returns all survey questions for a given merchant.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function surveyQuestions($request)
    {
        return self::dashboardRequest('GET', '/api/survey-questions', $request);
    }

    /**
     * Returns a single survey question with response data.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function surveyQuestion($request)
    {
        return self::dashboardRequest('GET', '/api/survey-questions/' . $request["questionId"], $request);
    }

    /**
     * Updates or creates a survey question.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function updateSurveyQuestion($request)
    {
        return self::dashboardRequest('POST', '/api/survey-questions', $request);
    }

    /**
     * Deletes a survey question.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deleteSurveyQuestion($request)
    {
        return self::dashboardRequest('DELETE', '/api/survey-questions/' . $request["questionId"], $request);
    }

    /**
     * Returns results for a single survey question.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function surveyResults($request)
    {
        return self::dashboardRequest('POST', '/api/survey-results', $request);
    }

    /**
     * Returns the media library for a given partner, merchant, or organization.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function media($request)
    {
        return self::dashboardRequest('GET', '/api/media', $request);
    }

    /**
     * Uploads a media asset to the media library.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function uploadMedia($request, $file)
    {
        return self::uploadRequest('/api/upload-media', $request, $file);
    }

    /**
     * Retrieves the current status of a file upload.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function uploadStatus($request)
    {
        return self::dashboardRequest('GET', '/api/media-upload/' . $request["uploadId"], $request);
    }

    /**
     * Returns the media details for a single media asset.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function mediaAsset($request)
    {
        return self::dashboardRequest('GET', '/api/media/' . $request["mediaId"], $request);
    }

    /**
     * Deletes a media asset.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deleteMediaAsset($request)
    {
        return self::dashboardRequest('DELETE', '/api/media/' . $request["mediaId"], $request);
    }

    /**
     * Returns a collection of slide shows.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function slideShows($request)
    {
        return self::dashboardRequest('GET', '/api/slide-shows', $request);
    }

    /**
     * Returns a single slide show with slides.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function slideShow($request)
    {
        return self::dashboardRequest('GET', '/api/slide-shows/' . $request["slideShowId"], $request);
    }

    /**
     * Updates or creates a slide show.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function updateSlideShow($request)
    {
        return self::dashboardRequest('POST', '/api/slide-shows', $request);
    }

    /**
     * Deletes a single slide show.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deleteSlideShow($request)
    {
        return self::dashboardRequest('DELETE', '/api/slide-shows/' . $request["slideShowId"], $request);
    }

    /**
     * Returns the terminal branding stack for a given set of API credentials.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function terminalBranding($request)
    {
        return self::dashboardRequest('GET', '/api/terminal-branding', $request);
    }

    /**
     * Updates a branding asset.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function updateBrandingAsset($request)
    {
        return self::dashboardRequest('POST', '/api/terminal-branding', $request);
    }

    /**
     * Deletes a branding asset.
     *
     * @param array $request The request body.
     *
     * @throws \BlockChyp\Exception\ConnectionException if the connection fails.
     *
     * @return array The API response.
     */

    public static function deleteBrandingAsset($request)
    {
        return self::dashboardRequest('DELETE', '/api/terminal-branding/' . $request["assetId"], $request);
    }

}

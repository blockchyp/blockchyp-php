<?php

namespace BlockChyp;

/**
 * Primary entry point for working with BlockChyp in PHP.
 *
 * @package BlockChyp
 */
class BlockChyp extends BlockChypClient {

  /**
   * tests connection to the gateway
   */
  public static function heartbeat($test)
  {

    return self::gatewayGet("/api/heartbeat", $test);

  }

  /**
   * Executes a standard direct preauth and capture.
   */
  public static function charge($request)
  {
    return self::routeTerminalRequest($request, "/api/charge", "/api/charge", "POST");
  }

  /**
   * Executes a preauthorization intended to be captured later.
   */
  public static function preauth($request)
  {
    return self::routeTerminalRequest($request, "/api/preauth", "/api/preauth", "POST");
  }

  /**
   * Tests connectivity with a payment terminal.
   */
  public static function ping($request)
  {
    return self::routeTerminalRequest($request, "/api/test", "/api/terminal-test", "POST");
  }

  /**
   * Checks the remaining balance on a payment method.
   */
  public static function balance($request)
  {
    return self::routeTerminalRequest($request, "/api/balance", "/api/balance", "POST");
  }

  /**
   * Clears the line item display and any in progress transaction.
   */
  public static function clear($request)
  {
    return self::routeTerminalRequest($request, "/api/clear", "/api/terminal-clear", "POST");
  }

  /**
   * Prompts the user to accept terms and conditions.
   */
  public static function termsAndConditions($request)
  {
    return self::routeTerminalRequest($request, "/api/tc", "/api/terminal-tc", "POST");
  }

  /**
   * Appends items to an existing transaction display Subtotal, Tax, and Total are
   * overwritten by the request. Items with the same description are combined into
   * groups.
   */
  public static function updateTransactionDisplay($request)
  {
    return self::routeTerminalRequest($request, "/api/txdisplay", "/api/terminal-txdisplay", "PUT");
  }

  /**
   * Displays a new transaction on the terminal.
   */
  public static function newTransactionDisplay($request)
  {
    return self::routeTerminalRequest($request, "/api/txdisplay", "/api/terminal-txdisplay", "POST");
  }

  /**
   * Asks the consumer text based question.
   */
  public static function textPrompt($request)
  {
    return self::routeTerminalRequest($request, "/api/text-prompt", "/api/text-prompt", "POST");
  }

  /**
   * Asks the consumer a yes/no question.
   */
  public static function booleanPrompt($request)
  {
    return self::routeTerminalRequest($request, "/api/boolean-prompt", "/api/boolean-prompt", "POST");
  }

  /**
   * Displays a short message on the terminal.
   */
  public static function message($request)
  {
    return self::routeTerminalRequest($request, "/api/message", "/api/message", "POST");
  }

  /**
   * Executes a refund.
   */
  public static function refund($request)
  {
    return self::routeTerminalRequest($request, "/api/refund", "/api/refund", "POST");
  }

  /**
   * Adds a new payment method to the token vault.
   */
  public static function enroll($request)
  {
    return self::routeTerminalRequest($request, "/api/enroll", "/api/enroll", "POST");
  }

  /**
   * Activates or recharges a gift card.
   */
  public static function giftActivate($request)
  {
    return self::routeTerminalRequest($request, "/api/gift-activate", "/api/gift-activate", "POST");
  }

  /**
   * Executes a manual time out reversal.
   *
   * We love time out reversals. Don't be afraid to use them whenever a request to a
   * BlockChyp terminal times out. You have up to two minutes to reverse any transaction.
   * The only caveat is that you must assign transactionRef values when you build the
   * original request. Otherwise, we have no real way of knowing which transaction you're
   * trying to reverse because we may not have assigned it an id yet. And if we did assign it an
   * id, you wouldn't know what it is because your request to the terminal timed out before
   * you got a response.
   */
  public static function reverse($request)
  {
    return self::gatewayRequest("/api/reverse", $request, "POST");
  }

  /**
   * Captures a preauthorization.
   */
  public static function capture($request)
  {
    return self::gatewayRequest("/api/capture", $request, "POST");
  }

  /**
   * Closes the current credit card batch.
   */
  public static function closeBatch($request)
  {
    return self::gatewayRequest("/api/close-batch", $request, "POST");
  }

  /**
   * Discards a previous preauth transaction.
   */
  public static function void($request)
  {
    return self::gatewayRequest("/api/void", $request, "POST");
  }

}

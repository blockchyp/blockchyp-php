<?php

namespace BlockChyp;

require_once(__DIR__ . '/CryptoUtils.php');

use DateInterval;
use DateTime;

/**
 * Base class for the PHP BlockChyp client.
 *
 * @package BlockChyp
 */
class BlockChypClient
{
    const CARD_TYPE_CREDIT = 0;
    const CARD_TYPE_DEBIT = 1;
    const CARD_TYPE_EBT = 2;
    const CARD_TYPE_BLOCKCHAIN_GIFT = 3;

    const SIGNATURE_FORMAT_NONE = '';
    const SIGNATURE_FORMAT_PNG = 'png';
    const SIGNATURE_FORMAT_JPG = 'jpg';
    const SIGNATURE_FORMAT_GIF = 'gif';

    const PROMPT_TYPE_AMOUNT = 'amount';
    const PROMPT_TYPE_EMAIL = 'email';
    const PROMPT_TYPE_PHONE_NUMBER = 'phone';
    const PROMPT_TYPE_CUSTOMER_NUMBER = 'customer-number';
    const PROMPT_TYPE_REWARDS_NUMBER = 'rewards-number';
    const PROMPT_TYPE_FIRST_NAME = 'first-name';
    const PROMPT_TYPE_LAST_NAME = 'last-name';

    const AVS_RESPONSE_NOT_APPLICABLE = '';
    const AVS_RESPONSE_NOT_SUPPORTED = 'not_supported';
    const AVS_RESPONSE_RETRY = 'retry';
    const AVS_RESPONSE_NO_MATCH = 'no_match';
    const AVS_RESPONSE_ADDRESS_MATCH = 'address_match';
    const AVS_RESPONSE_POSTAL_CODE_MATCH = 'zip_match';
    const AVS_RESPONSE_ADDRESS_AND_POSTAL_CODE_MATCH = 'match';

    const CVM_TYPE_SIGNATURE = 'Signature';
    const CVM_TYPE_OFFLINE_PIN = 'Offline PIN';
    const CVM_TYPE_ONLINE_PIN = 'Online PIN';
    const CVM_TYPE_CDCVM = 'CDCVM';
    const CVM_TYPE_NO_CVM = 'No CVM';

    const VERSION = '2.9.4';

    protected static $apiKey;

    protected static $bearerToken;

    protected static $signingKey;

    protected static $gatewayHost = 'https://api.blockchyp.com';

    protected static $testGatewayHost = 'https://test.blockchyp.com';

    protected static $https = true;

    protected static $routeCacheLocation;

    protected static $routeCacheTTL = 60;

    protected static $gatewayTimeout = 20;

    protected static $terminalTimeout = 120;

    protected static $offlineCacheEnabled = true;

    protected static $routeCache = [];

    private static $offlineFixedKey = 'cb22789c9d5c344a10e0474f134db39e25eb3bbf5a1b1a5e89b507f15ea9519c';

    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function setBearerToken($bearerToken)
    {
        self::$bearerToken = $bearerToken;
    }

    public static function setSigningKey($signingKey)
    {
        self::$signingKey = $signingKey;
    }

    public static function setGatewayHost($gatewayHost)
    {
        self::$gatewayHost = $gatewayHost;
    }

    public static function setTestGatewayHost($testGatewayHost)
    {
        self::$testGatewayHost = $testGatewayHost;
    }

    public static function setHttps($https)
    {
        self::$https = $https;
    }

    public static function setRouteCacheTTL($routeCacheTTL)
    {
        self::$routeCacheTTL = $routeCacheTTL;
    }

    public static function setRouteCacheLocation($routeCacheLocation)
    {
        self::$routeCacheLocation = $routeCacheLocation;
    }

    public static function setGatewayTimeout($gatewayTimeout)
    {
        self::$gatewayTimeout = $gatewayTimeout;
    }

    public static function setTerminalTimeout($terminalTimeout)
    {
        self::$terminalTimeout = $terminalTimeout;
    }

    protected static function routeTerminalRequest($method, $terminalPath, $cloudPath, $request)
    {
        $sigFormat = self::getSignatureOptions($request);
        if (!is_null($sigFormat)) {
            $request['sigFormat'] = $sigFormat;
        }

        if (!empty($request['terminalName'])) {
            $route = self::resolveTerminalRoute($request['terminalName']);
            if (empty($route) || empty($route['success'])) {
                return self::generateErrorResponse('Unknown Terminal');
            } elseif (!empty($route['cloudRelayEnabled'])) {
                $response = self::gatewayRequest($method, $cloudPath, $request, true);
            } else {
                $response = self::terminalRequest($method, $route, $terminalPath, $request);
            }
        } else {
            $response = self::gatewayRequest($method, $cloudPath, $request);
        }

        self::handleSignature($request, $response);

        return $response;
    }

    protected static function gatewayRequest($method, $path, $request=null, $relay=false)
    {
        $url = self::resolveGatewayURL($path, !empty($request['test']));

        $content = json_encode($request);

        $headers = self::generateGatewayHeaders();

        array_push($headers, 'Content-Type: application/json');
        array_push($headers, 'Content-Length: ' . strlen($content));

        $timeout = self::getTimeout($request, $relay ? self::$terminalTimeout : self::$gatewayTimeout);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, self::getUserAgent());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        try {
            if (!$result = curl_exec($ch)) {
                throw Exception\ConnectionException::factory(curl_error($ch));
            }
        } finally {
            curl_close($ch);
        }

        return json_decode($result, true);
    }

    private static function generateErrorResponse($msg)
    {
        return [
      'success' => false,
      'error' => $msg,
      'responseDescription' => $msg
    ];
    }

    private static function routeCacheGet($terminalName, $stale = false)
    {
        $cacheKey = self::toRouteKey($terminalName);

        if (isset(self::$routeCache[$cacheKey])) {
            $localRoute = self::$routeCache[$cacheKey];

            if (self::validRoute($localRoute, $stale)) {
                return $localRoute;
            }
        }

        if (self::$offlineCacheEnabled) {
            $offlineRoute = self::getOfflineRoute($cacheKey);
            if (self::validRoute($offlineRoute, $stale)) {
                self::$routeCache[$cacheKey] = $offlineRoute;
                return $offlineRoute;
            }
        }

        return false;
    }

    private static function toRouteKey($terminalName)
    {
        return sprintf("php_%s_%s", self::$apiKey, str_replace(' ', '_', $terminalName));
    }

    private static function validRoute($route, $stale = false)
    {
        if (empty($route) || empty($route['success'])) {
            return false;
        }

        return $stale || self::validRouteTime($route);
    }

    private static function validRouteTime($route)
    {
        if (empty($route['timestamp'])) {
            return false;
        }

        $timestamp = new DateTime($route['timestamp']);

        $expires = $timestamp->add(new DateInterval('PT' . self::$routeCacheTTL . 'M'));

        return $expires > new DateTime();
    }

    private static function getOfflineRoute($cacheKey)
    {
        $path = self::getCacheLocation($cacheKey);

        if (!file_exists($path)) {
            return false;
        }

        $content = json_decode(file_get_contents($path), true);

        if (empty($content['transientCredentials'])) {
            return false;
        }

        $creds = $content['transientCredentials'];
        $creds['apiKey'] = self::decrypt($creds['apiKey']);
        $creds['bearerToken'] = self::decrypt($creds['bearerToken']);
        $creds['signingKey'] = self::decrypt($creds['signingKey']);
        $content['transientCredentials'] = $creds;

        return $content;
    }

    private static function getCacheLocation($cacheKey)
    {
        if (!empty(self::$routeCacheLocation)) {
            return self::$routeCacheLocation . DIRECTORY_SEPARATOR . $cacheKey;
        }

        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . '.blockchyp-routes' . DIRECTORY_SEPARATOR . $cacheKey;
    }

    private static function refreshRoute($route)
    {
        $res = self::requestRouteFromGateway($route["terminalName"]);

        if (!$res) {
            return false;
        }

        if ($res["ipAddress"] != $route["ipAddress"]) {
            return $res;
        }

        return false;
    }

    private static function resolveTerminalRoute($terminalName)
    {
        $route = self::routeCacheGet($terminalName);
        if (!empty($route)) {
            return $route;
        }

        try {
            $route = self::requestRouteFromGateway($terminalName);
            if (empty($route)) {
                throw new Exception\ConnectionException('No route from gateway');
            }
        } catch (\Throwable | \Exception $e) {
            // Get from the offline cache even if it's expired.
            $route = self::routeCacheGet($terminalName, true);
            if (!empty($route)) {
                return $route;
            }

            throw $e;
        }

        self::routeCachePut($route);
        return $route;
    }

    private static function routeCachePut($route)
    {
        if (empty($route) || empty($route['terminalName'])) {
            return;
        }

        $cacheKey = self::toRouteKey($route['terminalName']);
        self::$routeCache[$cacheKey] = $route;

        if (self::$offlineCacheEnabled) {
            $creds = $route['transientCredentials'];
            $creds['apiKey'] = self::encrypt($creds['apiKey']);
            $creds['bearerToken'] = self::encrypt($creds['bearerToken']);
            $creds['signingKey'] = self::encrypt($creds['signingKey']);
            $route['transientCredentials'] = $creds;

            $path = self::getCacheLocation($cacheKey);

            $parent = dirname($path);
            if (!is_dir($parent)) {
                mkdir($parent, 0755, true);
            }

            $file = fopen($path, 'w');
            try {
                fwrite($file, json_encode($route));
            } finally {
                fclose($file);
            }
        }
    }

    private static function resolveTerminalURL($route, $path)
    {
        $url = '';
        if (self::$https) {
            $url = $url . 'https://';
        } else {
            $url = $url . 'http://';
        }
        $url = $url . $route['ipAddress'];
        if (self::$https) {
            $url = $url . ':8443';
        } else {
            $url = $url . ':8080';
        }
        $url = $url . $path;

        return $url;
    }

    private static function terminalRequest($method, $route, $path, $request, $evictEnabled=true)
    {
        $url = self::resolveTerminalURL($route, $path);

        $txCreds = $route['transientCredentials'];

        $wrappedRequest = [
            'apiKey' => $txCreds['apiKey'],
            'bearerToken' => $txCreds['bearerToken'],
            'signingKey' => $txCreds['signingKey'],
            'request' => $request
        ];

        $content = json_encode($wrappedRequest);

        $headers = [];
        array_push($headers, 'Content-Type: application/json');
        array_push($headers, 'Content-Length: ' . strlen($content));

        $timeout = self::getTimeout($request, self::$terminalTimeout);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, self::getUserAgent());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        if (self::$https) {
            curl_setopt($ch, CURLOPT_CAINFO, __DIR__.'/terminal.crt');
            curl_setopt($ch, CURLOPT_CAPATH, __DIR__.'/terminal.crt');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        try {
            if (!$result = curl_exec($ch)) {

                if ($evictEnabled && curl_errno($ch) == 28 && self::refreshRoute($route)) {
                    // Infinite recursion is prevented by checking that the route actually changed.
                    return self::terminalRequest($method, $route, $path, $request, false);
                } else {
                    throw Exception\ConnectionException::factory(curl_error($ch));
                }
            }
        } finally {
            curl_close($ch);
        }

        return json_decode($result, true);
    }

    private static function decrypt($cipherText)
    {
        $cipherText = hex2bin($cipherText);
        $key = self::deriveOfflineKey();
        $method = 'AES-256-CBC';
        $iv = substr($cipherText, 0, 16);
        $cipherText = substr($cipherText, 16, strlen($cipherText));
        return openssl_decrypt($cipherText, $method, $key, OPENSSL_RAW_DATA, $iv);
    }

    private static function encrypt($plainText)
    {
        $key = self::deriveOfflineKey();
        $method = 'AES-256-CBC';
        $iv = openssl_random_pseudo_bytes(16);
        $cipherText = openssl_encrypt($plainText, $method, $key, OPENSSL_RAW_DATA, $iv);
        return bin2hex($iv . $cipherText);
    }

    private static function deriveOfflineKey()
    {
        return hash('sha256', self::$offlineFixedKey . self::$signingKey);
    }

    private static function requestRouteFromGateway($terminalName)
    {
        $route = self::gatewayRequest('GET', '/api/terminal-route?terminal=' . urlencode($terminalName));
        if (!empty($route['error'])) {
            throw new Exception\ConnectionException($route['error']);
        }
        if (!self::validRoute($route, true)) {
            return false;
        }
        if (!empty($route['ipAddress'])) {
            $route['exists'] = true;
            $route['timestamp'] = date(DATE_RFC3339);

            return $route;
        }

        return false;
    }

    private static function resolveGatewayURL($path, $test)
    {
        $url = '';

        if ($test) {
            $url = $url . self::$testGatewayHost;
        } else {
            $url = $url . self::$gatewayHost;
        }

        return $url . $path;
    }

    private static function generateGatewayHeaders()
    {
        $nonce = generateNonce();
        $timestamp = timestamp();
        $sig = self::computeHmac($timestamp, $nonce);

        $headers = [
            'Nonce: ' . $nonce,
            'Timestamp: ' . $timestamp,
            'Authorization: Dual ' . self::$bearerToken . ':' . self::$apiKey. ':' . $sig
        ];

        return $headers;
    }

    private static function computeHmac($ts, $nonce)
    {
        $c = self::$apiKey . self::$bearerToken . $ts . $nonce;
        $sig = hash_hmac('sha256', $c, hex2bin(self::$signingKey));
        return $sig;
    }

    private static function getUserAgent()
    {
        return 'BlockChyp-PHP/' . BlockChyp::VERSION;
    }

    private static function getTimeout($request, $default)
    {
        return isset($request['timeout']) ? $request['timeout'] : $default;
    }

    private static function getSignatureOptions($request)
    {
        if (is_null($request) || empty($request['sigFile'])) {
            return null;
        }

        $pathinfo = pathinfo($request['sigFile']);

        if (!is_writable($pathinfo['dirname'])) {
            throw Exception\RequestException::factory(
                'File not writeable: ' . $request['sigFile'],
                null,
                null,
                'sigFile'
            );
        }

        if (!empty($request['sigFormat'])) {
            return null;
        }

        $ext = $pathinfo['extension'];

        switch ($ext) {
            case static::SIGNATURE_FORMAT_PNG:
            case static::SIGNATURE_FORMAT_JPG:
            case static::SIGNATURE_FORMAT_GIF:
                return $ext;
                break;
            default:
                throw Exception\RequestException::factory(
                    'Invalid format: ' . $ext,
                    null,
                    null,
                    'sigFormat'
                );
        }
    }

    private static function handleSignature($request, $response)
    {
        if (empty($request)
            || empty($response)
            || empty($request['sigFile'])
            || empty($response['sigFile'])
        ) {
            return;
        }

        $raw = hex2bin($response['sigFile']);

        try {
            $file = fopen($request['sigFile'], 'w');

            fwrite($file, $raw);
        } finally {
            fclose($file);
        }
    }
}

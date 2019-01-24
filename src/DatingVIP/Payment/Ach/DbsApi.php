<?php

/**
 * Ach_Bds_Api Class
 *
 * ACH Dynamic Billing System API
 *
 * @package         DatingVIP
 * @subpackage      Payment
 * @category        lib
 * @author          Boldizsar Bednarik <bbednarik@gmail.com>
 * @copyright       All rights reserved
 * @version         1.0
 */

namespace DatingVIP\Payment\Ach;

use DatingVIP\cURL\Request as cURL;

class DbsApi
{
    const ACH_SERVER_URL  = 'https://join.achbill.com';
    const CURL_AGENT      = 'PHP';
    const CURL_TIMEOUT    = 30;
    const VALID_TOAST_IPS = '209.99.11.30|209.99.11.50|209.99.11.157|209.99.11.200|209.99.11.179';

    private $curl;
    protected $request;
    protected $response;

    /**
     * @var ParamsBase
     */
    private $requestObject;

    /**
     * @var ResponseParams
     */
    private $responseObject;

    /**
     * @return ResponseParams
     */
    public function getResponseObject()
    {
        return $this->responseObject;
    }

    /**
     * @return ParamsBase
     */
    public function getRequestObject()
    {
        return $this->requestObject;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return http_build_query($this->request);
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Do a transaction on ACH server
     *
     * @param ParamsBase $transaction_params
     *
     * @return bool|ResponseParams
     */
    public function doTransaction(ParamsBase $transaction_params)
    {
        $this->requestObject = $transaction_params;

        $this->request = $transaction_params->generateParamsStringFromVariables();
        $result        = $this->sendRequest($this->getUrl());

        // error occurred

        if (empty($result)) {
            return false;
        }

        // valid response

        $response = new ResponseParams();
        $response->setVariablesFromString($this->response);

        $this->responseObject = $response;

        return $response;
    }

    /**
     * Returns the ACH base url
     *
     * @return string
     */
    private function getUrl()
    {
        return self::ACH_SERVER_URL . '/cgi-bin/man_trans.cgi';
    }

    /**
     * Send the Curl post request
     *
     * @param $url  string where we send the xml request
     *
     * @return bool returns false if there is a curl error
     */
    protected function sendRequest($url)
    {
        $this->curl = new cURL([CURLOPT_USERAGENT => self::CURL_AGENT]);
        $this->curl->setHeader('Content-Type', 'multipart/form-data;charset=UTF-8');
        $this->curl->setTimeout(self::CURL_TIMEOUT);

        try {
            $response       = $this->curl->post($url, $this->request);
            $this->response = $response->getData();
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Validate the IP
     *
     * @param $ip
     * @return bool
     */
    public function isToastIpValid($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) { return false; }
        return strpos( self::VALID_TOAST_IPS, $ip ) !== false;
    }
}

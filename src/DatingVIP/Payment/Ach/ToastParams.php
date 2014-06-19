<?php

/**
 * ToastParams Class
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

use DatingVIP\Payment\Ach\ParamsBase;

class ToastParams extends ParamsBase
{
    // status
    public $status;

    // toast related
    public $toastcode;
    public $history_id;
    public $order_id;
    public $consumer_unique;
    public $authcode;
    public $testtrans;
    public $reason;

    // postedVars
    public $PostedVars;

    // resposne

    /**
     * @var ResponseParams
     */
    public $response;

    /**
     * Function to translate params to array
     *
     * @param $params string
     *
     * @return array
     */
    protected function translateParams($params)
    {
        $params = str_replace("\n", '', $params);
        $params = str_replace("\r", '', $params);

        parse_str($params, $tarr);

        if (!empty($tarr['PostedVars'])) {
            $tarr['PostedVars'] = urldecode($tarr['PostedVars']);
            parse_str($tarr['PostedVars'], $pvtarr);
            $tarr['PostedVars'] = $pvtarr;
        }

        $this->fullResultArray = $tarr;

        return $tarr;
    }
}

<?php

/**
 * TransactionParams Class
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

class TransactionParams extends ParamsBase
{
    const PAYMENT_TYPE_CHECK = 'chk';
    const PAYMENT_TYPE_CC    = 'crd';

    // merchant

    public $parent_id;
    public $sub_id;
    public $pmt_type;
    public $response_location;
    public $history_id;
    public $order_id;

    // account

    public $acct_name;
    public $chk_acct;
    public $chk_aba;
    public $chk_fract;
    public $chk_number;
    public $currency;
    public $username;
    public $password;

    // customer

    public $custname;
    public $custemail;
    public $custaddress1;
    public $custaddress2;
    public $custcity;
    public $custstate;
    public $custzip;
    public $custphone;
    public $shipaddress1;
    public $shipaddress2;
    public $shipcity;
    public $shipstate;
    public $shipzip;
    public $custssn;
    public $birth_date;
    public $profile_id;
    public $initial_amount;
    public $billing_cycle;
    public $recur_amount;
    public $days_til_recur;
    public $max_num_billing;
    public $free_signup;

    // misc

    public $reseller_code;
    public $ip_forward;
    public $prev_history_id;
    public $prev_order_id;
    public $merordernumber;
    public $action_code;
    public $creditflag;

    // cancel

    public $canceltype;
}

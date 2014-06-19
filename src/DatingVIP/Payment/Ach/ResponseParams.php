<?php

/**
 * ResponseParams Class
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

class ResponseParams extends ParamsBase
{
    public $status;

    // status = verify

    public $url;
    public $toastcode;

    // status = accespted || declined

    public $duplicatetrans;
    public $reason;
    public $order_id;
    public $history_id;
    public $consumer_unique;
    public $authcode;
    public $xs_order_id;
    public $xs_profile_id;
    public $xs_history_id;
    public $xs_initial_amount;
    public $xs_sub_id;
    public $xs_trans_prenoted;
    public $xs_authcodet;
    public $xs_parent_id;
    public $testtrans;

    // the rest of the possible variables

    // merchant

    public $parent_id;
    public $sub_id;
    public $pmt_type;

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

    // account

    public $currency;
    public $crosssaleid;
    public $chk_number;
}

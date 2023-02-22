<?php

/**
 * TransactionRefundParams Class
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

class TransactionRefundParams extends ParamsBase
{
    public $pmt_type;
    public $parent_id;
    public $sub_id;
    public $prev_history_id;
    public $order_id;
    public $initial_amount;
    public $action_code;

    public $username;
    public $password;
    public $syspass;
}

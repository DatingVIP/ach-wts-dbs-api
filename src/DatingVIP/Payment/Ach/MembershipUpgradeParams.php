<?php

/**
 * MembershipUpgradeParams Class
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

class MembershipUpgradeParams extends ParamsBase
{
    public $action_code;
    public $sub_id;
    public $profile_id;
    public $billing_cycle;
    public $recur_amount;
    public $max_num_billing;
    public $consumer_code;
    public $order_id;
}

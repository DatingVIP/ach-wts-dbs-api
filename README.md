ACH WTS DBS API
===============

A PHP class to make the WTS ACH (achdebit.com) API usage easier. These classes are for Dynamic Billing System users.

Usage Examples
==============

```PHP
require_once 'vendor/autoload.php';

use DatingVIP\Payment\Ach\DbsApi;
use DatingVIP\Payment\Ach\TransactionParams;
use DatingVIP\Payment\Ach\ResponseParams;
use DatingVIP\Payment\Ach\TransactionRefundParams;
use DatingVIP\Payment\Ach\ToastParams;

// add your credentials here

$config = [
    'parent_id' => 'YOUR_PARTNER_ID',
    'sub_id'    => 'YOUR_SUB_ID'
];

$api = new DbsApi();

// create a subscription / re-billing

$params = new TransactionParams();

$params->parent_id = $config['parent_id'];
$params->sub_id    = $config['sub_id'];
$params->pmt_type  = TransactionParams::PAYMENT_TYPE_CHECK;

$params->response_location = 'http://example.com/listener/' . time();

$params->chk_acct = '123456789';
$params->chk_aba  = '987654321';

$params->custname     = 'John Smith';
$params->custemail    = 'jsmith@example.com';
$params->custaddress1 = 'Main Street';
$params->custstate    = 'TX';
$params->custzip      = '00893';
$params->custcity     = 'Austin';

$params->initial_amount  = '1.00';
$params->recur_amount    = '5.00';
$params->max_num_billing = '10';
$params->billing_cycle   = TransactionParams::CYCLE_MONTHLY;
$params->ip_forward      = $_SERVER['REMOTE_ADDR'];
$params->merordernumber  = time();

$api = new DbsApi();

$api->doTransaction($params);

// what do we got

switch ($api->getResponseObject()->status) {
    case ResponseParams::STATUS_ACCEPTED:
    case ResponseParams::STATUS_SUCCESS:
        // All good!
        echo 'Successful Payment!';
        break;

    case ResponseParams::STATUS_VERIFY:
        // Redirect user to WTS site
        // in this case we will need a listener which, which will handle returned data from join.achbill.com
        echo '<a href="' . $api->getResponseObject()->url . '" target="_blank">Finish payment!</a>';
        break;

    case ResponseParams::STATUS_DECLINED:
        // Declined transaction
        echo 'Transaction Declined! "' . $api->getResponseObject()->reason . '"';
        break;

    default:
        echo '???';
}

// cancel subscription example

$cparams = new TransactionParams();

$cparams->parent_id   = $config['parent_id'];
$cparams->sub_id      = $config['sub_id'];
$cparams->action_code = TransactionParams::ACTION_CANCEL;

$cparams->prev_history_id = 'history_id';
$cparams->order_id        = 'ach_order_id';
$cparams->canceltype      = TransactionParams::CANCEL_IMMEDIATE;

$api->doTransaction($cparams);

// refund transaction

$rparams = new TransactionRefundParams();

$rparams->parent_id = $config['parent_id'];
$rparams->sub_id    = $config['sub_id'];
$rparams->pmt_type  = TransactionParams::PAYMENT_TYPE_CHECK;

$rparams->action_code     = TransactionRefundParams::ACTION_REFUND;
$rparams->prev_history_id = 'history_id';
$rparams->order_id        = 'ach_order_id';
$rparams->initial_amount  = 'amount';

$api->doTransaction($rparams);

// example of how to handle TOAST's from the listener script

$tparams = new ToastParams();
$tparams->setVariablesFromString( http_build_query($_POST) );

if(!$api->isToastIpValid($_SERVER['REMOTE_ADDR'])) { die ( 'Toast IP is not valid!' ); }

switch ($tparams->status) {

    case ResponseParams::STATUS_ACCEPTED:
    case ResponseParams::STATUS_SUCCESS:
        // All good!
        break;

    default:
        // Declined
}
```
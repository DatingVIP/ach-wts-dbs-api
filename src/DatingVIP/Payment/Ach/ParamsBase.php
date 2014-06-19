<?php

/**
 * ParamsBase Class
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

class ParamsBase
{
    // statuses

    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';
    const STATUS_VERIFY   = 'verify';
    const STATUS_SUCCESS  = 'success';

    // billing cycles

    const CYCLE_ONETIME       = -1;
    const CYCLE_WEEKLY        = 1;
    const CYCLE_MONTHLY       = 2;
    const CYCLE_BI_MONTHLY    = 3;
    const CYCLE_QUARTERLY     = 4;
    const CYCLE_SEMI_ANNUALLY = 5;
    const CYCLE_YEARLY        = 6;
    const CYCLE_BI_WEEKLY     = 7;

    // action codes

    const ACTION_PROCESS        = 'P';
    const ACTION_VALIDATE       = 'V';
    const ACTION_REFUND         = 'R';
    const ACTION_QUEUE          = 'Q';
    const ACTION_FREE_QUEUED    = 'F';
    const ACTION_COMPLETE_TOAST = 'T';
    const ACTION_CANCEL         = 'C';

    // cancel type

    const CANCEL_STANDARD       = 1;
    const CANCEL_IMMEDIATE      = 2;

    // ---

    protected $param_value_container;

    protected $fullResultArray;

    public function getFullResultArray()
    {
        return $this->fullResultArray;
    }

    /**
     * Set class variables from string
     *
     * @param $variables string
     */
    public function setVariablesFromString($variables)
    {
        $this->param_value_container = $variables;
        $this->mapParamsToInstance();
    }

    /**
     * Function to translate params to array
     *
     * @param $params string
     *
     * @return array
     */
    protected function translateParams($params)
    {
        $parray = explode("\n", $params);
        $farr   = [];

        foreach ($parray as $cpar) {
            $tmp = explode('=', $cpar, 2);
            if (count($tmp) == 2) {
                $farr[$tmp[0]] = $tmp[1];
            }
        }

        $this->fullResultArray = $farr;

        return $farr;
    }

    /**
     * Function to populate params to class variables
     */

    protected function mapParamsToInstance()
    {
        $unified_params = $this->translateParams($this->param_value_container);

        foreach (array_keys(get_object_vars($this)) as $param) {
            if (!empty($unified_params[$param])) {
                $this->$param = $unified_params[$param];
            }
        }
    }

    /**
     * Function to build post string from class variables
     *
     * @return string
     */
    public function generateParamsStringFromVariables()
    {
        return http_build_query($this->generateParamsArrayFromVariables());
    }

    /**
     * Function to build post array from class variables
     *
     * @return string
     */
    public function generateParamsArrayFromVariables()
    {
        $ret = [];

        foreach (array_keys(get_object_vars($this)) as $param) {
            if (!empty($this->$param)) {
                $ret[$param] = $this->$param;
            }
        }

        return $ret;
    }
}

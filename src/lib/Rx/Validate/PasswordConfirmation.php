<?php
/**
 * Password Confirmation Validation
 *
 * This validator takes the current value of an item, and ensures that it matches
 * the corresponding password value
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Validate
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Password Confirmation Validation
 *
 * This validator takes the current value of an item, and ensures that it matches
 * the corresponding password value
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Validate
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_Validate_PasswordConfirmation
    extends Zend_Validate_Abstract
{
    /**
     * Constant for a not-match value
     */
    const NOT_MATCH = 'notMatch';

    /**
     * a list of message templates
     *
     * @var array
     */
    protected $_messageTemplates = array(
        self::NOT_MATCH => 'Password confirmation does not match',
    );

    /**
     * isValid()
     * @param  string  $value   the value being validated
     * @param  array|null  $context the list of other values (including the password)
     * @return boolean
     */
    public function isValid ($value, $context = null)
    {
        $value = (string)$value;
        $this->_setValue($value);

        var_dump($context); die;

        if (! is_array($context)) {
            return true;
        }

        if (isset($context['passwd']) && $value == $context['passwd']) {
            return true;
        }

        $this->_error(self::NOT_MATCH);
        return false;

    } // END function isValid

} // END class Rx_Validate_PasswordConfirmation
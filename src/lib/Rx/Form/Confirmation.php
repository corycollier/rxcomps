<?php
/**
 * Confirmation Form
 *
 * This form should be used to confirm things. Examples might be the deletion of
 * information, or the bulk editing of other information.
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Confirmation Form
 *
 * This form should be used to confirm things. Examples might be the deletion of
 * information, or the bulk editing of other information.
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Form_Confirmation
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Add the confirm and cancel buttons
     */
    public function init ( )
    {
        $this->addElement('reset', 'cancel', array(
            'label'     => 'Cancel',
            'ignore'    => true,
        ));

        $this->addElement('submit', 'confirm', array(
            'label'     => 'Confirm',
            'ignore'    => true,
        ));

        $this->setDecorators(array(
            'FormElements',
            'Fieldset',
            'Form',
        ));

        $this->setElementDecorators(array(
            'ViewHelper',
        ));

        $this->getDecorator('Fieldset')->setOption('class', 'buttons');

    } // END function init

} // END class Rx_Form_Confirmation
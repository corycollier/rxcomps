<?php
/**
 * Search Form
 *
 * The search form for models
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Search Form
 *
 * The search form for models
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_Form_Search
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Initializes the form
     */
    public function init ( )
    {
        $this->addElement('text', 'q', array(
            'class'         => 'search input',
            'placeholder'   => 'search terms',
            'validators'    => array(
                array('StringLength', true, array(
                    'min' => 3,
                )),
            ),
        ));

        $this->setMethod('GET');

        // parent::init();

        $this->setDecorators(array('FormElements', 'Form'));

    } // END function init

} // END class Rx_Form_Search
<?php
/**
 * Search Form
 *
 * The search form for models
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
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
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
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
            'placeholder' => 'search terms',
            'validators'    => array(
                array('StringLength', true, array(
                    'min' => 3,
                )),
            ),
        ));

        $this->addElement('submit', 'search', array(
            'ignore' => true,
            'class' => 'adjoined',
        ));

        $this->setMethod('GET');

        parent::init();

    } // END function init

} // END class Rx_Form_Search
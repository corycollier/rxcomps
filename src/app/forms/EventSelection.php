<?php
/**
 * Event Selection Form
 *
 * This form allows for selection of an event from a data source
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Event Selection Form
 *
 * This form allows for selection of an event from a data source
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Form_EventSelection
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Local implementation of the init hook, to setup elements
     */
    public function init ( )
    {
        $this->addElement('select', 'event_id', array(
            'label'     => 'Event',
            'required'  => true,
        ));

        $this->addElement('submit', 'select');

        $this->setMethod('GET');

    } // END function init

    /**
     * buildOptions()
     *
     * Build the options for the event_id element
     *
     * @return App_Form_EventSelection $this for object chaining
     */
    public function buildOptions ( )
    {
        $event = new App_Model_DbTable_Event;

        $element = $this->getElement('event_id');

        $results = $event->fetchAll();

        foreach ($results as $result) {
            $element->addMultiOption($result->id, $result->name);
        }
    }

} // END class App_Form_EventSelection
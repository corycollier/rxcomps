<?php
/**
 * Admin Form
 *
 * Form for administering many event options at one time
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2013 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Athlete Form
 *
 * Form for administering many event options at one time
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2013 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Form_EventAdmin
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Local implementation of the init hook
     */
    public function init ( )
    {

    } // END function init

    /**
     * injectDependencies()
     *
     * Implementation of the injectDependencies hook to add event options subforms
     *
     * @param App_Model_Event $model
     * @param ArrayObject $params
     */
    public function injectDependencies ($model, $params = array())
    {
        foreach ($params as $eventOption) {
            $eventId = $eventOption->getValue('event_id');
            $name = $eventOption->getValue('name');
            $value = $eventOption->getValue('value');

            if (! $eventId || ! $name || !$value) {
                continue;
            }

            $form = $this->getEventOptionForm($eventId, $name, $value);
            $this->addSubform($form, $name);
        }

        $this->addElement('submit', 'save', array(
            'ignore' => true,
        ));
    }

    /**
     * getEventOptionForm()
     *
     * Gets a new instance of an event-option form
     *
     * @return App_Form_EventOption
     */
    public function getEventOptionForm ($eventId, $belongsTo, $value = null)
    {
        $form = new App_Form_EventOption;
        $form->getElement('event_id')->setValue($eventId);
        $form->getElement('name')->setValue($belongsTo);
        $form->getElement('value')->setValue($value);
        $form->removeElement('save');
        $form->setDecorators(array('FormElements'));
        $form->setIsArray(true);
        $form->setElementsBelongTo($belongsTo);
        return $form;

    }


} // END class App_Form_Athlete
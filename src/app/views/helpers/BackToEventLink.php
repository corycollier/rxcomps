<?php
/**
 * Back To Event Link View Helper
 *
 * This view helper displays a link to return a viewer to a parent event page
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Back To Event Link View Helper
 *
 * This view helper displays a link to return a viewer to a parent event page
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_View_Helper_BackToEventLink
    extends Rx_View_Helper_HtmlAnchor
{
    /**
     * Message to indicate that there is no event parent model
     */
    const EXCEPTION_NO_EVENT_MODEL = 'There is no event model parent for the supplied model [%s]';

    /**
     * backToEventLink()
     *
     * Creates a link to a parent event page
     *
     * @param  Rx_Model_Abstract $model the model that has an event parent
     * @param  array $params the request params
     * @return string the anchor markup
     */
    public function backToEventLink ($model, $params)
    {
        $eventId = isset($params['event_id'])
            ? $params['event_id']
            : $params['id'];

        $event = $model->getParent('Event');

        if (! $event) {
            throw new Rx_View_Helper_Exception(
                sprintf(self::EXCEPTION_NO_EVENT_MODEL, get_class($model))
            );
        }

        $event = $event->load($eventId);

        $html = '<div class="small default btn icon-right icon-back">%s</div>';

        $link = $this->htmlAnchor(sprintf('Back to %s', $event->getValue('name')), array(
            'controller'    => 'events',
            'action'        => 'view',
            'id'            => $event->id,
            'event_id'      => $event->id,
            'reset-url'     => true,
        ));


        return sprintf($html, $link);

    } // END function backToEventLink

} // END class App_View_Helper_AthleteItem
<?php
/**
 * Scale Filter View Helper
 *
 * This view helper provides a list of links that allow a user to add the scale_id
 * to the current location, thus allowing for the filtering of current items
 * by scale_id
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Scale Filter View Helper
 *
 * This view helper provides a list of links that allow a user to add the scale_id
 * to the current location, thus allowing for the filtering of current items
 * by scale_id
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_ScaleFilter
    extends Zend_View_Helper_HtmlList
{
    /**
     * _getScaleTable()
     *
     * Gets a new instance of the scale database table class
     *
     * @return App_Model_DbTable_Scale
     */
    protected function _getScaleTable ( )
    {
        return new App_Model_DbTable_Scale;

    } // END function _getScaleTable

    /**
     * getScales()
     *
     * Gets all of the scales in the system
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getScales ($eventId)
    {
        $table = $this->_getScaleTable();

        $scales = $table->fetchAll(sprintf('event_id = "%d"', $eventId));

        return $scales;

    } // END function getScales

    /**
     * scaleFilter()
     *
     * Returns an html list of links to filter by scale_id
     *
     * @return string
     */
    public function scaleFilter ($eventId)
    {
        $scales = $this->getScales($eventId);

        $urls = array();

        foreach ($scales as $scale) {
            $urls[] = $this->view->htmlAnchor($scale->name, array(
                'scale_id' => $scale->id,
            ));
        }

        return $this->htmlList($urls, false, array('class' => 'subnav'), false);

    } // END function scaleFilter

} // END class App_View_Helper_ScaleFilter

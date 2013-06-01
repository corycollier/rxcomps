<?php
/**
 * Gender Filter View Helper
 *
 * This view helper allows for the filtering of results by gender
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
 * Gender Filter View Helper
 *
 * This view helper allows for the filtering of results by gender
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_GenderFilter
    extends Zend_View_Helper_HtmlList
{
    public function genderFilter ( )
    {
        $genders = array(
            'male'     => 'Male',
            'female'   => 'Female',
            'team'     => 'Team',
        );

        $urls = array();

        foreach ($genders as $key => $value) {
            $urls[] = $this->view->htmlAnchor($value, array(
                'gender' => $key,
            ));
        }

        return $this->htmlList($urls, false, array('class' => 'subnav'), false);

    }


} // END class App_View_Helper_GenderFilter
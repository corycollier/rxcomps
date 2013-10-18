<?php
/**
 * Leaderboard Selection Form
 *
 * This form allows for the selecting of a specific leaderboard, then sets the
 * action of this form to that value, thus allowing for redirection
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Leaderboard Selection Form
 *
 * This form allows for the selecting of a specific leaderboard, then sets the
 * action of this form to that value, thus allowing for redirection
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Form_Leaderboard
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Method to initialize all of the elements of the form
     */
    public function init ( )
    {
        $this->addElement('select', 'gender', array(
            'multiOptions'  => array(
                'male' => 'male',
                'female' => 'female',
            ),
        ));

        $this->addElement('select', 'scale_id', array(

        ));

        $this->addElement('submit', 'submit', array(
            'ignore'    => true,
        ));

        $this->setMethod('GET');

    } // END function init

    /**
     * build()
     *
     * Method to build information into the form, that isn't available during
     * time of construction/initialization
     *
     * @param Zend_Db_Table_Rowset $scales
     * @return App_Form_Leaderboard $this for object-chaining
     */
    public function build ($scales, $request)
    {
        $options    = array();
        foreach ($scales as $scale) {
            $options[$scale->id] = $scale->name;
        }

        $this->getElement('scale_id')->addMultiOptions($options);
        $this->getElement('scale_id')->setValue($request->getParam('scale_id'));
        $this->getElement('gender')->setValue($request->getParam('gender'));

        return $this;

    }

} // END class App_Form_Leaderboard
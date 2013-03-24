<?php
/**
 * View Helper for models
 *
 * This view helper will display links that allow actions on models
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * View Helper for models
 *
 * This view helper will display links that allow actions on models
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_View_Helper_Model
    extends Zend_View_Helper_HtmlElement
{
    /**
     * stores the model
     *
     * @var Rx_Model_Abstract
     */
    protected $_model;

    /**
     * model()
     *
     * The main entry point to the helper. This method sets the model into the
     * helper, to preface all later methods
     *
     * @param Rx_Model_Abstract $model
     * @param string|null $modelName If this is set, then the $model variable is just a row
     * @return Rx_View_Helper_Model $this for object-chaining
     */
    public function model ($model, $modelName = null)
    {
        if ($modelName) {
            $row = $model;
            $model = new $modelName;
            $model->fromRow($row);
        }

        $this->_model = $model;

        return $this;

    } // END function model


    /**
     * links()
     *
     * This method is the way to get links for a given model
     *
     * @param App_Model_User $user
     * @param array $params
     * @return string
     */
    public function links ($user, $params = array())
    {
        $acl = $this->_getAcl();
        if (! $acl) {
            return;
        }

        $resourceId = $this->_model->getResourceId();
        $roleId     = $user->getRoleId();
        $privileges = array('edit', 'delete');
        $links      = array();

        foreach ($privileges as $privilege) {
            if (! $acl->isAllowed($roleId, $resourceId, $privilege)) {
                continue;
            }

            $links[] = $this->view->htmlAnchor($privilege, array_merge($params, array(
                'controller' => $resourceId,
                'action'     => $privilege,
                'id'        => $this->_model->id
            )));
        }

        if (empty($links)) {
            return;
        }

        return $this->view->actionList($links);

    } // END function modelLinks

    /**
     * create()
     *
     * Method to return a create link for a given model
     *
     * @param string $title
     * @param array $params
     * @return string
     */
    public function create ($user, $title, $params = array())
    {
        $acl = $this->_getAcl();
        if (! $acl) {
            return;
        }

        $resourceId = $this->_model->getResourceId();
        $roleId     = $user->getRoleId();
        $privilege  = 'create';

        if (! $acl->isAllowed($roleId, $resourceId, $privilege)) {
            return;
        }

        return $this->view->htmlAnchor($title, array_merge($params, array(
            'controller'    => $resourceId,
            'action'        => $privilege,
        )));

    } // END function create

    /**
     * id()
     *
     * Gets the id of the event
     *
     * @return string
     */
    public function id ( )
    {
        return $this->_model->id;

    } // END function id

    /**
     * getRegistry()
     *
     * Method to get the global registry object. This method helps in unit testing
     *
     * @return Zend_Registry
     */
    protected function _getRegistry ( )
    {
        return Zend_Registry::getInstance();

    } // END function getRegistry

    /**
     * _getAcl()
     *
     * Method to get the acl object from the registry
     *
     * @return Zend_Acl
     */
    protected function _getAcl ( )
    {
        return $this->_getRegistry()->get('acl');

    }

} // END class Rx_View_Helper_ModelLinks
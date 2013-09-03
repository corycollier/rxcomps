<?php
/**
 * View Helper for models
 *
 * This view helper will display links that allow actions on models
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxComps, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxComps, Inc (http://www.RxComps.com)
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
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName;

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
            if ($row instanceof Rx_Model_Abstract) {
                $row = $model->row;
            }

            $model = new $modelName;
            $model->fromRow($row);
        }

        $this->_model = $model;

        return $this;

    } // END function model

    /**
     * item()
     *
     * A way to display the model as an item
     *
     * @param Rx_Model_Abstract|Zend_Db_Table_Row $model
     * @return string
     */
    public function item ($user, $params = array(), $attribs = array())
    {
        $attribs['class'] = @$attribs['class'] . ' list-item';

        $title = $this->_getTitle($this->_model);

        $attribs = $this->_htmlAttribs($attribs);

        $actions = $this->links($user, $params);

        return sprintf('<div %s>%s%s</div>', $attribs, $title, $actions);

    } // END function athleteItem

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
        $resourceId = $this->_model->getResourceId();
        $roleId     = $user->getRoleId();
        $privileges = array('edit', 'delete');
        $icons      = array('edit' => 'pencil', 'delete' => 'cancel-circled');
        $links      = array();

        foreach ($privileges as $privilege) {
            $class = 'admin-edit-link small default btn icon-right icon-' . $icons[$privilege];

            $links[] = '<div class="' . $class . '">'
                . $this->view->htmlAnchor($privilege, array_merge($params, array(
                    'controller' => $resourceId,
                    'action'     => $privilege,
                    'id'        => $this->_model->id
                )))
                . '</div>';
        }

        if (empty($links)) {
            return;
        }

        return '<div class="action-links">' . implode(' ', $links) . '</div>';

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
        $resourceId = $this->_model->getResourceId();
        $privilege  = 'create';

        $html = '<div class="admin-edit-link small default btn icon-right icon-list-add">%s</div>';

        $link = $this->view->htmlAnchor($title, array_merge($params, array(
            'controller'    => $resourceId,
            'action'        => $privilege,
        )));

        return sprintf($html, $link);

    } // END function create

    /**
     * search()
     *
     * this method provides a search form for a given model
     *
     * @return string
     */
    public function search ($params)
    {
        $form = new Rx_Form_Search;

        $form->setAction($this->view->url($params['formAction']));

        return $form;

    } // END function search

    /**
     * csv()
     *
     * Method to return a csv link for a given model
     *
     * @param string $title
     * @param array $params
     * @return string
     */
    public function csv ($user, $title, $params = array())
    {
        $resourceId = $this->_model->getResourceId();
        $privilege  = 'list';

        $html = '<div class="admin-edit-link small default btn icon-right icon-list-add">%s</div>';

        $link = $this->view->htmlAnchor($title, array_merge($params, array(
            'controller'    => $resourceId,
            'action'        => $privilege,
            'format'        => 'csv',
            'reset-url' => true,
        )));

        return sprintf($html, $link);

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
     * getValue()
     *
     * Passthrough method to get a model value
     *
     * @param  string $name the name of the property requested
     * @return mixed the value
     */
    public function getValue ($name)
    {
        return $this->_model->getValue($name);
    }

} // END class Rx_View_Helper_ModelLinks
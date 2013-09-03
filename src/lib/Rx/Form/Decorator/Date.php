<?php
/**
 * Date Form Element Decorator
 *
 * This form element decorator helps build the view for a multi-input element
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form_Decorator
 * @copyright   Copyright (c) 2013 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Date Form Element Decorator
 *
 * This form element decorator helps build the view for a multi-input element
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form_Decorator
 * @copyright   Copyright (c) 2013 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */
class Rx_Form_Decorator_Date
    extends Zend_Form_Decorator_Abstract
{
    /**
     * render()
     *
     * Local override of the render method, to build the multi-input element
     *
     * The design of this element was heavily influenced by code found at the
     * following location {@see http://www.mwop.net/blog/217-Creating-composite-elements.html}
     *
     * @param string $content
     * @return string
     */
    public function render ($content)
    {
        $element = $this->getElement();
        if (!$element instanceof Rx_Form_Element_Date) {
            // only want to render Date elements
            return $content;
        }

        $view = $element->getView();
        if (!$view instanceof Zend_View_Interface) {
            // using view helpers, so do nothing if no view present
            return $content;
        }

        $day   = $element->getDay();
        $month = $element->getMonth();
        $year  = $element->getYear();
        $name  = $element->getFullyQualifiedName();

        $years = array_combine(
            range(1900, date('Y')),
            range(1900, date('Y'))
        );

        $months = array_combine(
            range(1, 12),
            range(1, 12)
        );

        $days = array_combine(
            range(1, 31),
            range(1, 31)
        );

        $markup = implode('-', array(
            $view->formSelect($name . '[year]', $year,  array(), $years),
            $view->formSelect($name . '[month]', $month, array(), $months),
            $view->formSelect($name . '[day]', $day, array(), $days),
        ));

        if ($this->getPlacement() == self::PREPEND) {
            return $markup . $this->getSeparator() . $content;
        }

        return $content . $this->getSeparator() . $markup;
    }

} // END class Rx_Form_Decorator_Date
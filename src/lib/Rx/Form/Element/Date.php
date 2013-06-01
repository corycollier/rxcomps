<?php
/**
 * Date Form Element
 *
 * This form element is a combination element that allows for selecting a date
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Form_Element
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Date Form Element
 *
 * This form element is a combination element that allows for selecting a date
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Form_Element
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_Form_Element_Date
    extends Zend_Form_Element_Xhtml
{
    /**
     * storing the date format
     */
    const DATE_FORMAT = '!year-!month-!day';

    /**
     * storing the day of the date
     *
     * @var string
     */
    protected $_day;

    /**
     * storing the month of the date
     *
     * @var string
     */
    protected $_month;

    /**
     * storing the year of the date
     *
     * @var string
     */
    protected $_year;

    /**
     * setDay()
     *
     * setter for the _day property
     *
     * @param string|integer $value
     * @return Rx_Form_Element_Date $this for object-chaining
     */
    public function setDay ($value)
    {
        $this->_day = sprintf("%02d", (int)$value);
        return $this;
    }

    /**
     * getDay()
     *
     * getter for the _day property
     *
     * @return integer
     */
    public function getDay ( )
    {
        return $this->_day;
    }

    /**
     * setMonth()
     *
     * setter for the _month property
     *
     * @param string|integer $value
     * @return Rx_Form_Element_Date $this for object-chaining
     */
    public function setMonth ($value)
    {
        $this->_month = sprintf("%02d", (int)$value);
        return $this;
    }

    /**
     * getMonth()
     *
     * getter for the _month property
     *
     * @return integer
     */
    public function getMonth ( )
    {
        return $this->_month;
    }

    /**
     * setYear()
     *
     * setter for the _year property
     *
     * @param string|integer $value
     * @return Rx_Form_Element_Date $this for object-chaining
     */
    public function setYear ($value)
    {
        $this->_year = $value;
        return $this;
    }

    /**
     * getYear()
     *
     * getter for the _year property
     *
     * @return integer
     */
    public function getYear ( )
    {
        return $this->_year;
    }

    /**
     * setValue()
     *
     * Sets the value of the element
     *
     * @param string|array|integer $value
     * @return Rx_Form_Element_Date $this for object-chaining
     */
    public function setValue ($value)
    {
        if (is_int($value)) {
            $this->setDay(date('d', $value))
                 ->setMonth(date('m', $value))
                 ->setYear(date('Y', $value));
        } elseif (is_string($value)) {
            $date = strtotime($value);
            $this->setDay(date('d', $date))
                 ->setMonth(date('m', $date))
                 ->setYear(date('Y', $date));
        } elseif (is_array($value)
            && (isset($value['day'])
                && isset($value['month'])
                && isset($value['year'])
            )
        ) {
            $this->setDay($value['day'])
                 ->setMonth($value['month'])
                 ->setYear($value['year']);
        } else {
            $value = (int)$value;
            $this->setDay(date('d', $value))
                 ->setMonth(date('m', $value))
                 ->setYear(date('Y', $value));
        }

        return $this;
    }

    /**
     * getValue()
     *
     * Gets the value of the element
     *
     * @return string
     */
    public function getValue ( )
    {
        return strtr(self::DATE_FORMAT, array(
            '!year' => $this->getYear(),
            '!month'=> $this->getMonth(),
            '!day'  => $this->getDay(),
        ));

    } // END function getValue

    /**
     * loadDefaultDecorators()
     *
     * Local override to insert specific decorators
     */
    public function loadDefaultDecorators ( )
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('Date')
                ->addDecorator('Label', array(
                    'class' => 'adjoined'
                ))
                ->addDecorator('Errors', array('class' => 'danger label'))
                ->addDecorator('Label')
                ->addDecorator('Description', array(
                    'tag' => 'p', 'class' => 'description'
                ));
        }

        $this->addDecorators(array(
            array(array('elementDiv' => 'HtmlTag'), array(
                'tag' => 'div',
                'class' => 'select',
            )),
            array(array('td' => 'HtmlTag'), array(
                'tag' => 'div',
                'class' => 'field',
            )),
        ));

    } // END function loadDefaultDecorators

} // END class Rx_Form_Element_Date
<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Text form element
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Text.php 23775 2011-03-01 17:25:24Z ralph $
 */
class Rx_Form_Element_Numeric
    extends Rx_Form_Element_Text
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formNumber';

    /**
     * Load default decorators
     *
     * Disables "for" attribute of label if label decorator enabled.
     *
     * @return Zend_Form_Element_Radio
     */
    public function loadDefaultDecorators ( )
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('ViewHelper', array(
                    'class' => 'numeric input',
                ))
                ->addDecorator('Label', array(
                    'class' => 'adjoined'
                ))
                ->addDecorator('Errors', array('class' => 'danger label'))
                ->addDecorator('Description', array(
                    'tag' => 'p',
                    'class' => 'description'
                ));
        }

        $this->addDecorators(array(
            // array(array('textDiv' => 'HtmlTag'), array(
            //     'tag' => 'div',
            //     'class' => 'text',
            // )),
            array(array('fieldDiv' => 'HtmlTag'), array(
                'tag' => 'div',
                'class' => 'prepend field',
            )),
        ));

        return $this;
    }
}

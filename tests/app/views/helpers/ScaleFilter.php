<?php
/**
 * Unit Tests for App_View_Helper_ScaleFilter
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_ScaleFilter class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Tests for App_View_Helper_ScaleFilter
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_ScaleFilter class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_View_Helper_ScaleFilter
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_scaleFilter()
     *
     * Tests the scaleFilter of the App_View_Helper_ScaleFilter
     *
     * @covers          App_View_Helper_ScaleFilter::scaleFilter
     * @dataProvider    provide_scaleFilter
     */
    public function test_scaleFilter ($eventId)
    {
        $expected = '<ul><li>stuff</li></ul>';

        $scales = array(
            (object)array(
                'id'    => 1,
                'name'  => 'scale 1',
            ),
        );

        $urls = array('scale-link');

        $subject = $this->getBuiltMock('App_View_Helper_ScaleFilter', array(
            'getScales', 'htmlList',
        ));

        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->exactly(count($scales)))
            ->method('htmlAnchor')
            ->will($this->returnValue('scale-link'));

        $subject->expects($this->once())
            ->method('getScales')
            ->with($this->equalTo($eventId))
            ->will($this->returnValue($scales));

        $subject->expects($this->once())
            ->method('htmlList')
            ->with(
                $this->equalTo($urls),
                $this->equalTo(false),
                $this->equalTo(array('class' => 'subnav')),
                $this->equalTo(false)
            )
            ->will($this->returnValue($expected));

        $subject->view = $view;

        $result = $subject->scaleFilter($eventId);

        $this->assertEquals($expected, $result);



    } // END function test_scaleFilter

    /**
     * provide_scaleFilter()
     *
     * Provides data for the scaleFilter method of the
     * App_View_Helper_ScaleFilter class
     */
    public function provide_scaleFilter ( )
    {
        return array(
            array(
                1
            ),
        );

    } // END function provide_scaleFilter

    /**
     * test_getScales()
     *
     * Tests the getScales method of the App_View_Helper_ScaleFilter class
     *
     * @covers App_View_Helper_ScaleFilter::getScales
     * @dataProvider provide_getScales
     */
    public function test_getScales ($eventId)
    {
        $expected = array('stuff');

        $subject = $this->getBuiltMock('App_View_Helper_ScaleFilter', array(
            '_getScaleTable',
        ));
        $table = $this->getBuiltMock('App_Model_DbTable_Scale', array('fetchAll'));

        $table->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(sprintf('event_id = "%d"', $eventId)))
            ->will($this->returnValue($expected));

        $subject->expects($this->once())
            ->method('_getScaleTable')
            ->will($this->returnValue($table));

        $result = $subject->getScales($eventId);

        $this->assertEquals($expected, $result);

    } // END function test_getScales

    /**
     * provide_getScales()
     *
     * Provides data to use for testing the getScales method of
     * the App_View_Helper_ScaleFilter class
     *
     * @return array
     */
    public function provide_getScales ( )
    {
        return array(
            array(1),
        );

    } // END function provide_getScales

    /**
     * test__getScaleTable()
     *
     * Tests the _getScaleTable method of the App_View_Helper_ScaleFilter class
     *
     * @covers App_View_Helper_ScaleFilter::_getScaleTable
     */
    public function test__getScaleTable ( )
    {
        $subject = new App_View_Helper_ScaleFilter;
        $method = new ReflectionMethod('App_View_Helper_ScaleFilter', '_getScaleTable');
        $method->setAccessible(true);
        $result = $method->invoke($subject);
        $this->assertInstanceOf('App_Model_DbTable_Scale', $result);

    } // END function test__getScaleTable

} // END class Tests_App_View_Helper_AtheleteItem

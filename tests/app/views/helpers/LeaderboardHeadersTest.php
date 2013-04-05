<?php
/**
 * Unit Test Suite for the App_View_Helper_LeaderboardHeaders class
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_LeaderboardHeaders class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the App_View_Helper_LeaderboardHeaders
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_LeaderboardHeaders class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_View_Helper_LeaderboardHeadersTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getRequest()
     *
     * Tests the getRequest method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::getRequest
     */
    public function test_getRequest ( )
    {
        $subject = new App_View_Helper_LeaderboardHeaders;
        $view = $this->getBuiltMock('Zend_View', array('request'));
        $request = new Zend_Controller_Request_HttpTestCase;

        $view->expects($this->once())
            ->method('request')
            ->will($this->returnValue($request));

        $subject->view = $view;

        $result = $subject->getRequest();

        $this->assertSame($request, $result);

    } // END function test_getRequest

    /**
     * test_getFilters()
     *
     * Tests the getFilters method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::getFilters
     * @dataProvider provide_getFilters
     */
    public function test_getFilters ($expected, $filters = '')
    {
        $subject = $this->getBuiltMock('App_View_Helper_LeaderboardHeaders', array('getRequest'));
        $request = new Zend_Controller_Request_HttpTestCase;

        $request->setParam('filters', $filters);
        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $result = $subject->getFilters();

        $this->assertEquals($expected, $result);

    } // END function test_getFilters

    /**
     * provide_getFilters()
     *
     * Provides data to use for testing the getFilters method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide_getFilters ( )
    {
        return array(
            'no filters' => array(
                'expected'  => array(''),
                'filters'   => null,
            ),

            '1 filter' => array(
                'expected'  => array('1'),
                'filters'   => '1',
            ),

            '2 filters' => array(
                'expected'  => array('1', '2'),
                'filters'   => '1,2',
            ),
        );

    } // END function provide_getFilters

    /**
     * test_isFiltered()
     *
     * Tests the isFiltered method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::isFiltered
     * @dataProvider provide_isFiltered
     */
    public function test_isFiltered ($expected, $competitionId, $filters = array())
    {
        $subject = $this->getBuiltMock('App_View_Helper_LeaderboardHeaders', array('getFilters'));
        $subject->expects($this->once())
            ->method('getFilters')
            ->will($this->returnValue($filters));

        $result = $subject->isFiltered($competitionId);

        $this->assertEquals($expected, $result);

    } // END function test_isFiltered

    /**
     * provide_isFiltered()
     *
     * Provides data to use for testing the isFiltered method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide_isFiltered ( )
    {
        return array(
            'no filters, expect false' => array(
                'expected'      => false,
                'competitionId' => 1,
                'filters'       => array(),
            ),

            'has filters, id not in filter array, expect false' => array(
                'expected'      => false,
                'competitionId' => 1,
                'filters'       => array(2,3,4,5),
            ),

            'has filters, id in filter array, expect true' => array(
                'expected'      => true,
                'competitionId' => 1,
                'filters'       => array(1,2,3,4,5),
            ),
        );

    } // END function provide_isFiltered

    /**
     * test__getUnfilteredHeading()
     *
     * Tests the _getUnfilteredHeading method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::_getUnfilteredHeading
     * @dataProvider provide__getUnfilteredHeading
     */
    public function test__getUnfilteredHeading ($expected, $competition, $link = '', $filters = '')
    {
        $subject = new App_View_Helper_LeaderboardHeaders;
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->will($this->returnValue($link));

        $subject->view = $view;

        $method = new ReflectionMethod(get_class($subject), '_getUnfilteredHeading');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competition, $filters);

        $this->assertEquals($expected, $result);

    } // END function test__getUnfilteredHeading

    /**
     * provide__getUnfilteredHeading()
     *
     * Provides data to use for testing the _getUnfilteredHeading method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide__getUnfilteredHeading ( )
    {
        return array(
            'simple test' => array(
                'expected'      => '<th class="">name value link-value</th>',
                'competition'   => (object)array('name' => 'name value', 'id' => 1),
                'link'          => 'link-value',
                'filters'       => '',
            ),
        );

    } // END function provide__getUnfilteredHeading

    /**
     * test__getFilteredHeading()
     *
     * Tests the _getFilteredHeading method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::_getFilteredHeading
     * @dataProvider provide__getFilteredHeading
     */
    public function test__getFilteredHeading ($expected, $competition, $link = '', $filters = '')
    {
        $subject = new App_View_Helper_LeaderboardHeaders;
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->will($this->returnValue($link));

        $subject->view = $view;

        $method = new ReflectionMethod(get_class($subject), '_getFilteredHeading');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competition, $filters);

        $this->assertEquals($expected, $result);


    } // END function test__getFilteredHeading

    /**
     * provide__getFilteredHeading()
     *
     * Provides data to use for testing the _getFilteredHeading method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide__getFilteredHeading ( )
    {
        return array(
            'simple test' => array(
                'expected'      => '<th class="filtered">name value <i class="icon-cancel-circled"></i></th>',
                'competition'   => (object)array('name' => 'name value', 'id' => 1),
                'link'          => '<i class="icon-cancel-circled"></i>',
                'filters'       => '',
            ),
        );

    } // END function provide__getFilteredHeading

    /**
     * test__getHeaders()
     *
     * Tests the _getHeaders method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::_getHeaders
     * @dataProvider provide__getHeaders
     */
    public function test__getHeaders ($expected = array(), $competitions = array())
    {
        $filters = '';
        $request = new Zend_Controller_Request_HttpTestCase;
        $subject = $this->getBuiltMock('App_View_Helper_LeaderboardHeaders', array(
            'getRequest',
            '_getHeading',
        ));

        $request->setParam('filters', $filters);
        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $subject->expects($this->any())
            ->method('_getHeading')
            ->with($this->anything(), $this->equalTo($filters))
            ->will($this->returnValue($expected[0]));

        $method = new ReflectionMethod('App_View_Helper_LeaderboardHeaders', '_getHeaders');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competitions);

        $this->assertEquals($expected, $result);

    } // END function test__getHeaders

    /**
     * provide__getHeaders()
     *
     * Provides data to use for testing the _getHeaders method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide__getHeaders ( )
    {
        return array(
            array(
                'expected' => array(
                    'result 1',
                ),
                'competitions' => array(
                    (object)array('id' => 1),
                ),
            ),
        );

    } // END function provide__getHeaders

    /**
     * test__getHeading()
     *
     * Tests the _getHeading method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::_getHeading
     * @dataProvider provide__getHeading
     */
    public function test__getHeading ($isFiltered, $competition, $filters = '')
    {
        $subject = $this->getBuiltMock('App_View_Helper_LeaderboardHeaders', array(
            'isFiltered',
            '_getFilteredHeading',
            '_getUnfilteredHeading',
        ));

        $expected = 'expected value';

        $subject->expects($this->once())
            ->method('isFiltered')
            ->with($this->equalTo($competition->id))
            ->will($this->returnValue($isFiltered));

        $subject->expects($this->once())
            ->method($isFiltered
                ? '_getFilteredHeading'
                : '_getUnfilteredHeading'
            )
            ->with($this->equalTo($competition), $this->equalTo($filters))
            ->will($this->returnValue($expected));

        $method = new ReflectionMethod('App_View_Helper_LeaderboardHeaders', '_getHeading');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competition, $filters);

        $this->assertEquals($expected, $result);

    } // END function test__getHeading

    /**
     * provide__getHeading()
     *
     * Provides data to use for testing the _getHeading method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide__getHeading ( )
    {
        return array(
            'is filtered, has no filter values' => array(
                'isFiltered'    => true,
                'competition'   => (object)array('id' => 1),
                'filters'       => '',
            ),

            'is NOT filtered, has no filter values' => array(
                'isFiltered'    => false,
                'competition'   => (object)array('id' => 1),
                'filters'       => '',
            ),
        );

    } // END function provide__getHeading

    /**
     * test_leaderboardHeaders()
     *
     * Tests the leaderboardHeaders method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::leaderboardHeaders
     * @dataProvider provide_leaderboardHeaders
     */
    public function test_leaderboardHeaders ($headers = array(), $data = array())
    {
        $expected = sprintf('<tr><th class="athlete-name">Team</th>%s</th>', implode('', $headers));
        $competitions = array();
        $subject = $this->getBuiltMock('App_View_Helper_LeaderboardHeaders', array(
            '_getCompetitions',
            '_getHeaders',
        ));

        $subject->expects($this->once())
            ->method('_getCompetitions')
            ->with($this->equalTo($data))
            ->will($this->returnValue($competitions));

        $subject->expects($this->once())
            ->method('_getHeaders')
            ->with($this->equalTo($competitions))
            ->will($this->returnValue($headers));

        $result = $subject->leaderboardHeaders($data);

        $this->assertEquals($expected, $result);

    } // END function test_leaderboardHeaders

    /**
     * provide_leaderboardHeaders()
     *
     * Provides data to use for testing the leaderboardHeaders method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide_leaderboardHeaders ( )
    {
        return array(
            'no headers, no data' => array(
                'headers'  => array(),
                'data'      => array()
            ),

            'has headers, no data' => array(
                'headers'  => array('header 1', 'header 2'),
                'data'      => array()
            ),
        );

    } // END function provide_leaderboardHeaders

    /**
     * test__getCompetitions()
     *
     * Tests the _getCompetitions method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::_getCompetitions
     * @dataProvider provide__getCompetitions
     */
    public function test__getCompetitions ($expected, $data = array())
    {
        $class = 'App_View_Helper_LeaderboardHeaders';
        $subject = $this->getBuiltMock($class, array('_getCompetitionTable'));
        $table = $this->getBuiltMock('App_Model_DbTable_Competitions', array('select', 'fetchAll'));
        $select = $this->getBuiltMock('Zend_Db_Table_Select', array('where'));
        $competitionIds = array();
        if (array_key_exists('competitions', $data)) {
            $competitionIds = array_keys($data['competitions']);

            $select->expects($this->once())
                ->method('where')
                ->with($this->equalTo('id in (?)'), $this->equalTo($competitionIds))
                ->will($this->returnSelf());

            $table->expects($this->once())
                ->method('select')
                ->will($this->returnValue($select));

            $table->expects($this->once())
                ->method('fetchAll')
                ->with($this->equalTo($select))
                ->will($this->returnValue($expected));

            $subject->expects($this->once())
                ->method('_getCompetitionTable')
                ->will($this->returnValue($table));
        }

        $method = new ReflectionMethod($class, '_getCompetitions');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $data);

        $this->assertEquals($expected, $result);

    } // END function test__getCompetitions

    /**
     * provide__getCompetitions()
     *
     * Provides data to use for testing the _getCompetitions method of
     * the App_View_Helper_LeaderboardHeaders class
     *
     * @return array
     */
    public function provide__getCompetitions ( )
    {
        return array(
            'no data' => array(
                'expected'  => array(),
                'data'      => array(),
            ),

            'has data, but no competitions data' => array(
                'expected'  => array(),
                'data'      => array('id' => 1, 'key' => 'value'),
            ),

            'has competition data' => array(
                'expected'  => array(),
                'data'      => array(
                    'competitions' => range(1, 5),
                ),
            ),
        );

    } // END function provide__getCompetitions

    /**
     * test__getCompetitionTable()
     *
     * Tests the _getCompetitionTable method of the App_View_Helper_LeaderboardHeaders class
     *
     * @covers App_View_Helper_LeaderboardHeaders::_getCompetitionTable
     */
    public function test__getCompetitionTable ( )
    {
        $subject = new App_View_Helper_LeaderboardHeaders;
        $method = new ReflectionMethod('App_View_Helper_LeaderboardHeaders', '_getCompetitionTable');
        $method->setAccessible(true);
        $result = $method->invoke($subject);

        $this->assertInstanceOf('App_Model_DbTable_Competition', $result);

    } // END function test__getCompetitionTable

} // END class Tests_App_View_Helper_LeaderboardHeadersTest
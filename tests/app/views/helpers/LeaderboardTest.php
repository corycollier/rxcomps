<?php
/**
 * Unit Test Suite for the App_View_Helper_Leaderboard class
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_Leaderboard class
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
 * Unit Test Suite for the App_View_Helper_Leaderboard
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_Leaderboard class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_View_Helper_LeaderboardTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getRequest()
     *
     * Tests the getRequest method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::getRequest
     */
    public function test_getRequest ( )
    {
        $subject = new App_View_Helper_Leaderboard;
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
     * Tests the getFilters method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::getFilters
     * @dataProvider provide_getFilters
     */
    public function test_getFilters ($expected, $filters = '')
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array('getRequest'));
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
     * the App_View_Helper_Leaderboard class
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
     * Tests the isFiltered method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::isFiltered
     * @dataProvider provide_isFiltered
     */
    public function test_isFiltered ($expected, $competitionId, $filters = array())
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array('getFilters'));
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
     * the App_View_Helper_Leaderboard class
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
     * Tests the _getUnfilteredHeading method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::_getUnfilteredHeading
     * @dataProvider provide__getUnfilteredHeading
     */
    public function test__getUnfilteredHeading ($expected, $competition, $link = '', $filters = '')
    {
        $subject = new App_View_Helper_Leaderboard;
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
     * the App_View_Helper_Leaderboard class
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
     * Tests the _getFilteredHeading method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::_getFilteredHeading
     * @dataProvider provide__getFilteredHeading
     */
    public function test__getFilteredHeading ($expected, $competition, $link = '', $filters = '')
    {
        $subject = new App_View_Helper_Leaderboard;
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
     * the App_View_Helper_Leaderboard class
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
     * Tests the _getHeaders method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::_getHeaders
     * @dataProvider provide__getHeaders
     */
    public function test__getHeaders ($expected = array(), $competitions = array())
    {
        $filters = '';
        $request = new Zend_Controller_Request_HttpTestCase;
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array(
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

        $method = new ReflectionMethod('App_View_Helper_Leaderboard', '_getHeaders');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competitions);

        $this->assertEquals($expected, $result);

    } // END function test__getHeaders

    /**
     * provide__getHeaders()
     *
     * Provides data to use for testing the _getHeaders method of
     * the App_View_Helper_Leaderboard class
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
     * Tests the _getHeading method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::_getHeading
     * @dataProvider provide__getHeading
     */
    public function test__getHeading ($isFiltered, $competition, $filters = '')
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array(
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

        $method = new ReflectionMethod('App_View_Helper_Leaderboard', '_getHeading');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competition, $filters);

        $this->assertEquals($expected, $result);

    } // END function test__getHeading

    /**
     * provide__getHeading()
     *
     * Provides data to use for testing the _getHeading method of
     * the App_View_Helper_Leaderboard class
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
     * test_headers()
     *
     * Tests the headers method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::headers
     * @dataProvider provide_headers
     */
    public function test_headers ($headers = array(), $data = array())
    {
        $expected = sprintf('<tr><th class="athlete-name">Team</th>%s</th>', implode('', $headers));
        $competitions = array();
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array(
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

        $result = $subject->headers($data);

        $this->assertEquals($expected, $result);

    } // END function test_headers

    /**
     * provide_headers()
     *
     * Provides data to use for testing the headers method of
     * the App_View_Helper_Leaderboard class
     *
     * @return array
     */
    public function provide_headers ( )
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

    } // END function provide_headers

    /**
     * test__getCompetitions()
     *
     * Tests the _getCompetitions method of the App_View_Helper_Leaderboard class
     *
     * @covers App_View_Helper_Leaderboard::_getCompetitions
     * @dataProvider provide__getCompetitions
     */
    public function test__getCompetitions ($expected, $data = array())
    {
        $class = 'App_View_Helper_Leaderboard';
        $subject = $this->getBuiltMock($class, array('getTable'));
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
                ->method('getTable')
                ->with($this->equalTo('Competition'))
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
     * the App_View_Helper_Leaderboard class
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
     * test__link()
     *
     * Tests the _link of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::_link
     * @dataProvider    provide__link
     */
    public function test__link ($expected, $label, $params = array())
    {
        $subject = new App_View_Helper_Leaderboard;
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with($this->equalTo($label), $this->equalTo($params))
            ->will($this->returnValue($expected));


        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_Leaderboard', '_link');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $label, $params);

        $this->assertEquals($expected, $result);

    } // END function test__link

    /**
     * provide__link()
     *
     * Provides data for the _link method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide__link ( )
    {
        return array(
            'expect empty string, simple label, no params' => array(
                'expected'  => '',
                'label'     => 'label',
                'params'    => array(),
            ),
        );

    } // END function provide__link

    /**
     * test_leaderboard()
     *
     * Tests the leaderboard of the App_View_Helper_Leaderboard
     *
     * @covers App_View_Helper_Leaderboard::leaderboard
     */
    public function test_leaderboard ( )
    {
        $subject = new App_View_Helper_Leaderboard;
        $result = $subject->leaderboard();
        $this->assertSame($subject, $result);

    } // END function test_leaderboard


    /**
     * test_table()
     *
     * Tests the table of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::table
     * @dataProvider    provide_table
     */
    public function test_table ($headers, $rows, $data = array())
    {
        $class = 'App_View_Helper_Leaderboard';
        $subject = $this->getBuiltMock($class, array('headers', 'rows'));
        $expected = '<table class="data-table leaderboards-table">'
            . $headers
            . $rows
            . '</table>';

        $subject->expects($this->once())
            ->method('headers')
            ->with($this->equalTo($data[0]))
            ->will($this->returnValue($headers));

        $subject->expects($this->once())
            ->method('rows')
            ->with($this->equalTo($data))
            ->will($this->returnValue($rows));

        $result = $subject->table($data);

        $this->assertEquals($expected, $result);


    } // END function test_table

    /**
     * provide_table()
     *
     * Provides data for the table method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_table ( )
    {
        return array(
            'simple test' => array(
                'headers'   => '',
                'rows'      => '',
                'data'      => array(array()),
            ),
        );

    } // END function provide_table

    /**
     * test_rows()
     *
     * Tests the rows of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::rows
     * @dataProvider    provide_rows
     */
    public function test_rows ($data = array())
    {
        $class = 'App_View_Helper_Leaderboard';
        $subject = $this->getBuiltMock($class, array('row'));

        $expected = str_repeat('row', count($data));

        $subject->expects($this->exactly(count($data)))
            ->method('row')
            ->with($this->anything(), $this->anything())
            ->will($this->returnValue('row'));

        $result = $subject->rows($data);

        $this->assertEquals($expected, $result);

    } // END function test_rows

    /**
     * provide_rows()
     *
     * Provides data for the rows method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_rows ( )
    {
        return array(
            'single athlete value' => array(
                'data' => array(
                    array('points' => 2),
                )
            ),

            'double athlete value' => array(
                'data' => array(
                    array('points' => 1),
                    array('points' => 2),
                )
            ),
        );

    } // END function provide_rows

    /**
     * test_row()
     *
     * Tests the row of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::row
     * @dataProvider    provide_row
     */
    public function test_row ($expected, $data, $rank, $link, $athlete, $competitions = '')
    {
        $class = 'App_View_Helper_Leaderboard';
        $subject = $this->getBuiltMock($class, array(
            'getAthlete',
            'getCompetitionResults',
            '_link'
        ));

        if (array_key_exists('athlete_id', $data)) {
            $subject->expects($this->once())
                ->method('getAthlete')
                ->with($this->equalTo($data['athlete_id']))
                ->will($this->returnValue($athlete));

            $subject->expects($this->once())
                ->method('getCompetitionResults')
                ->with($this->equalTo($data))
                ->will($this->returnValue($competitions));

            $subject->expects($this->once())
                ->method('_link')
                ->with($this->equalTo(ucwords($athlete->name)), $this->equalTo(array(
                    'controller'    => 'athletes',
                    'action'        => 'view',
                    'id'            => $athlete->id,
                )))
                ->will($this->returnValue($link));
        }

        $result = $subject->row($data, $rank);

        $this->assertEquals($expected, $result);

    } // END function test_row

    /**
     * provide_row()
     *
     * Provides data for the row method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_row ( )
    {
        $template = '<tr><td class="athlete-name">%s %d <span class="alt">(%d)</span></td>%s</tr>';
        $link = 'link';

        return array(
            // no athlete_id, expect empty string
            'no athlete_id, expect empty string' => array(
                'expected'  => '',
                'data'      => array(),
                'rank'      => 1,
                'link'      => '',
                'athlete'   => (object)array(),
                'competitions' => array(''),
            ),

            // has athlete_id, expect markup
            'has athlete_id, expect markup' => array(
                'expected'  => sprintf($template,
                    $link, 1, 1, ''
                ),
                'data'      => array(
                    'athlete_id' => 1,
                    'points'    => 1,
                ),
                'rank'      => 1,
                'link'      => $link,
                'athlete'   => (object)array(
                    'id'    => 1,
                    'name'  => 'athlete name',
                ),
                'competitions' => array(''),
            ),
        );

    } // END function provide_row

    /**
     * test_getAthlete()
     *
     * Tests the getAthlete of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::getAthlete
     * @dataProvider    provide_getAthlete
     */
    public function test_getAthlete ($expected, $id)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array('getTable'));
        $table = $this->getBuiltMock('App_Model_DbTable_Athlete', array('fetchRow'));

        $table->expects($this->once())
            ->method('fetchRow')
            ->with($this->equalTo(sprintf('id = %d', $id)))
            ->will($this->returnValue($expected));

        $subject->expects($this->once())
            ->method('getTable')
            ->with($this->equalTo('Athlete'))
            ->will($this->returnValue($table));

        $result = $subject->getAthlete($id);

        $this->assertEquals($expected, $result);

    } // END function test_getAthlete

    /**
     * provide_getAthlete()
     *
     * Provides data for the getAthlete method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_getAthlete ( )
    {
        return array(
            'simple test' => array(
                'expected'  => 'expected value',
                'id'        => 1,
            ),
        );

    } // END function provide_getAthlete

    /**
     * test_getCompetition()
     *
     * Tests the getCompetition of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::getCompetition
     * @dataProvider    provide_getCompetition
     */
    public function test_getCompetition ($expected, $id)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array('getTable'));
        $table = $this->getBuiltMock('App_Model_DbTable_Competition', array('fetchRow'));

        $table->expects($this->once())
            ->method('fetchRow')
            ->with($this->equalTo(sprintf('id = %d', $id)))
            ->will($this->returnValue($expected));

        $subject->expects($this->once())
            ->method('getTable')
            ->with($this->equalTo('Competition'))
            ->will($this->returnValue($table));

        $result = $subject->getCompetition($id);

        $this->assertEquals($expected, $result);

    } // END function test_getCompetition

    /**
     * provide_getCompetition()
     *
     * Provides data for the getCompetition method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_getCompetition ( )
    {
        return array(
            'simple test' => array(
                'expected'  => 'expected value',
                'id'        => 1,
            ),
        );

    } // END function provide_getCompetition

    /**
     * test_getCompetitionResults()
     *
     * Tests the getCompetitionResults of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::getCompetitionResults
     * @dataProvider    provide_getCompetitionResults
     */
    public function test_getCompetitionResults ($data)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array('getCompetitionResult'));
        $getCompetitionResult = 'competition result';
        $count = count($data['competitions']);
        $expected = array_fill(0, $count, $getCompetitionResult);

        $subject->expects($this->exactly($count))
            ->method('getCompetitionResult')
            ->with($this->equalTo($data['goal']), $this->anything(), $this->anything())
            ->will($this->returnValue($getCompetitionResult));

        $result = $subject->getCompetitionResults($data);

        $this->assertEquals($expected, $result);


    } // END function test_getCompetitionResults

    /**
     * provide_getCompetitionResults()
     *
     * Provides data for the getCompetitionResults method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_getCompetitionResults ( )
    {
        return array(
            // empty competitions
            '1 competition' => array(
                'data'  => array(
                    'goal' => 'goal value',
                    'competitions' => array(1),
                ),
            ),
        );

    } // END function provide_getCompetitionResults

    /**
     * test_getCompetitionResult()
     *
     * Tests the getCompetitionResult of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::getCompetitionResult
     * @dataProvider    provide_getCompetitionResult
     */
    public function test_getCompetitionResult ($expected, $goal, $id, $isFiltered, $competition = array())
    {
        $subject = $this->getBuiltMock('App_View_Helper_Leaderboard', array('_getScoreEditLink', 'isFiltered'));
        $getScoreEditLink = 'score edit link';

        $subject->expects($this->once())
            ->method('isFiltered')
            ->with($this->equalTo($id))
            ->will($this->returnValue($isFiltered));

        $subject->expects($this->once())
            ->method('_getScoreEditLink')
            ->with($this->equalTo($id), $this->anything())
            ->will($this->returnValue($getScoreEditLink));

        $result = $subject->getCompetitionResult($goal, $id, $competition);

        $this->assertEquals($expected, $result);


    } // END function test_getCompetitionResult

    /**
     * provide_getCompetitionResult()
     *
     * Provides data for the getCompetitionResult method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide_getCompetitionResult ( )
    {
        $template = '<td class="%s">
            <a href="#" class="expand-details">%d</a>
            <span class="alt">(%s) %s</span>
            </td>';

        //$expected, $goal, $id, $isFiltered, $competition = array())
        return array(
            // simple test
            'no placeholder score, rank is 1, score is 100' => array(
                'expected'      => sprintf($template,
                    '',     // not filtered
                    1,      // rank is 1
                    100,    // score is 100
                    'score edit link' // the score edit link is constant
                ),
                'goal'          => '',
                'id'            => '',
                'isFiltered'    => false,
                'competition'   => array(
                    'rank' => 1,
                    'score' => 100,
                ),
            ),

            // has placeholder score, rank is 1, score is 100
            'has placeholder score, rank is 1, score is 100' => array(
                'expected'      => sprintf($template,
                    '',     // not filtered
                    1,      // rank is 1
                    '--',   // score is 100
                    'score edit link' // the score edit link is constant
                ),
                'goal'          => '',
                'id'            => '',
                'isFiltered'    => false,
                'competition'   => array(
                    'rank' => 1,
                    'score' => 100,
                    'placeholder_score' => true,
                ),
            ),


            // no placeholder score, rank is 1, score is 100, goal is time
            'no placeholder score, rank is 1, score is 100, goal is time' => array(
                'expected'      => sprintf($template,
                    '',     // not filtered
                    1,      // rank is 1
                    '1:40', // score is 100, but the goal is time
                    'score edit link' // the score edit link is constant
                ),
                'goal'          => 'time',
                'id'            => '',
                'isFiltered'    => false,
                'competition'   => array(
                    'rank' => 1,
                    'score' => 100,
                ),
            ),

        );

    } // END function provide_getCompetitionResult

    /**
     * test__getScoreEditLink()
     *
     * Tests the _getScoreEditLink of the App_View_Helper_Leaderboard
     *
     * @covers          App_View_Helper_Leaderboard::_getScoreEditLink
     * @dataProvider    provide__getScoreEditLink
     */
    public function test__getScoreEditLink ($link, $competitionId, $action, $data)
    {
        $class = 'App_View_Helper_Leaderboard';
        $subject = $this->getBuiltMock($class, array('_link'));
        $html   = '<div class="small default btn icon-right icon-pencil">%s</div>';
        $expected = sprintf($html, $link);

        $subject->expects($this->once())
            ->method('_link')
            ->with($this->equalTo($action), $this->equalTo(array(
                'module'        => 'default',
                'controller'    => 'scores',
                'action'        => $action,
                'id'            => $data['score_id'],
                'competition_id'=> $competitionId,
                'athlete_id'    => $data['athlete_id'],

            )))
            ->will($this->returnValue($link));

        $method = new ReflectionMethod($class, '_getScoreEditLink');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $competitionId, $data);

        $this->assertEquals($expected, $result);


    } // END function test__getScoreEditLink

    /**
     * provide__getScoreEditLink()
     *
     * Provides data for the _getScoreEditLink method of the
     * App_View_Helper_Leaderboard class
     */
    public function provide__getScoreEditLink ( )
    {
        return array(
            // compId = 5, score_id = 100, athlete_id = 20, action = edit
            array(
                'link'          => 'link',
                'competitionId' => 5,
                'action'        => 'edit',
                'data'          => array(
                    'athlete_id' => 20,
                    'score_id' => 100,
                ),
            ),

            // compId = 5, score_id = 100, athlete_id = 20, action = edit
            array(
                'link'          => 'link',
                'competitionId' => 5,
                'action'        => 'create',
                'data'          => array(
                    'athlete_id' => 20,
                    'score_id' => 100,
                    'placeholder_score' => true,
                ),
            ),
        );

    } // END function provide__getScoreEditLink


} // END class Tests_App_View_Helper_LeaderboardTest
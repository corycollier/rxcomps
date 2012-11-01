<?php
/**
 * Unit Test Suite for the Competition class
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Competition class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the Competition
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Competition class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_CompetitionTest
    extends PHPUnit_Framework_TestCase
{

    /**
     * test_create()
     *
     * Tests the create method of the App_Model_Competition class
     *
     * @covers App_Model_Competition::create
     * @dataProvider provide_create
     */
    public function test_create ($values)
    {
        $subject = $this->getMockBuilder('App_Model_Competition')
            ->setMethods(array('_create', '_saveScoring'))
            ->disableOriginalConstructor()
            ->getMock();

        $created = new Zend_Date;
        $modified = $values;
        $modified['created'] = $created;
        $modified['updated'] = $created;

        $subject->expects($this->once())
            ->method('_create')
            ->with($this->equalTo($modified))
            ->will($this->returnSelf());

        $subject->expects($this->once())
            ->method('_saveScoring')
            ->with($this->equalTo(@$values['scoring']));

        $result = $subject->create($values);

        $this->assertSame($subject, $result);

    } // END function test_create

    /**
     * provide_create()
     *
     * Provides data to use for testing the create method of
     * the App_Model_Competition class
     *
     * @return array
     */
    public function provide_create ( )
    {
        return array(
            array(array(
                'stuff' => 'value',
            )),
        );

    } // END function provide_create

    /**
     * test_edit()
     *
     * Tests the edit method of the App_Model_Competition class
     *
     * @covers App_Model_Competition::edit
     * @dataProvider provide_edit
     */
    public function test_edit ($values = array())
    {
        $subject = $this->getMockBuilder('App_Model_Competition')
            ->setMethods(array('_edit', '_saveScoring'))
            ->disableOriginalConstructor()
            ->getMock();

        $updated = new Zend_Date;
        $modified = $values;
        $modified['updated'] = $updated;

        $subject->expects($this->once())
            ->method('_edit')
            ->with($this->equalTo($modified))
            ->will($this->returnSelf());

        $subject->expects($this->once())
            ->method('_saveScoring')
            ->with($this->equalTo(@$values['scoring']));

        $result = $subject->edit($values);

        $this->assertSame($subject, $result);

    } // END function test_edit

    /**
     * provide_edit()
     *
     * Provides data to use for testing the edit method of
     * the App_Model_Competition class
     *
     * @return array
     */
    public function provide_edit ( )
    {
        return array(
            array(array(
                'stuff' => 'value',
            )),
        );

    } // END function provide_edit

    /**
     * test__getScoringTable()
     *
     * Tests the _getScoringTable method of the App_Model_Competition class
     *
     * @covers App_Model_Competition::_getScoringTable
     */
    public function test__getScoringTable ( )
    {
        $subject = new App_Model_Competition;

        $method = new ReflectionMethod('App_Model_Competition', '_getScoringTable');
        $method->setAccessible(true);

        $result = $method->invoke($subject);

        $this->assertInstanceOf('App_Model_DbTable_Scoring', $result);

    } // END function test__getScoringTable

} // END class Tests_App_Model_CompetitionTest
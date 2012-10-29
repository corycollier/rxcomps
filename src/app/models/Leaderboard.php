<?php
/**
 * Leaderboard model
 *
 * This is the leaderboard model, which doesn't have a dbTable directly
 * associated with it
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Leaderboard model
 *
 * This is the leaderboard model, which doesn't have a dbTable directly
 * associated with it
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Leaderboard
{
    /**
     * getScoreTable()
     *
     * Gets an instance of the score table class
     *
     * @return App_Model_DbTable_Score
     */
    public function getScoreTable ( )
    {
        return new App_Model_DbTable_Score;

    } // END function getScoreTable

    /**
     * load()
     *
     * Loads up the leaderboards for a given competition
     *
     * @param integer $competitionId
     * @return App_Model_Leaderboard $this for object chaining
     */
    public function load ($competitionId)
    {
        $table = $this->getScoreTable();

        return $table->fetchAll(
            $table->select()
                ->where(sprintf('competition_id = %d', $competitionId))
                ->order('score DESC')
        );

    } // END function load

} // END class App_Model_Leaderboard
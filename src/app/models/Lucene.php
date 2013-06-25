<?php
/**
 * Lucene Model
 *
 * This model is used to facilitate the creation and updating of lucene indexes
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Lucene Model
 *
 * This model is used to facilitate the creation and updating of lucene indexes
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Model_Lucene
{
    /**
     *
     */
    const ERR_MODEL_INTERFACE_REQ
        = 'The provided model does not implement App_Model_SearchableInterface';

    /**
     * buildIndex()
     *
     * Method to build a search index by model name
     *
     * @param string $modelName
     * @return App_Model_Lucene $this for object-chaining
     */
    public function buildIndex ($modelName)
    {
        $model = new $modelName;
        if (! $model instanceof App_Model_Interface_Searchable) {
            throw new Rx_Model_Exception(self::ERR_MODEL_INTERFACE_REQ);
        }

        $data = $model->getTable()->fetchAll();

        // var_dump($data); die;

        $fields = $model->getSearchFields();

        $path = $this->_getIndexPath($modelName);

        Zend_Search_Lucene::create($path);
        $index = Zend_Search_Lucene::open($path);

        foreach ($data as $datum) {
            $doc = $this->_getNewDoc();
            foreach ($fields as $property => $type) {
                $doc->addField(Zend_Search_Lucene_Field::$type($property, $datum->$property));
            }
            $index->addDocument($doc);
        }

        $index->optimize();

        return $this;

    }

    /**
     * search()
     *
     * Method to search an index with
     *
     * @param string $modelName
     * @param string $query
     * @return array
     */
    public function search ($modelName, $query)
    {
        $index = $this->_getIndex($modelName);

        $query = Zend_Search_Lucene_Search_QueryParser::parse("{$query}*");

        $hits = $index->find($query);

        return $hits;

    } // END function search

    /**
     * _getNewDoc()
     *
     * Gets a new Zend_Search_Lucene_Document instance
     *
     * @return Zend_Search_Lucene_Document
     */
    protected function _getNewDoc ( )
    {
        return new Zend_Search_Lucene_Document;

    } // END function _getNewDoc

    /**
     * _getIndex()
     *
     * Method to get a search index by model name
     *
     * @param string $modelName
     * @return d
     */
    protected function _getIndex ($modelName)
    {
        $path = $this->_getIndexPath($modelName);

        $index = Zend_Search_Lucene::open($path);

        return $index;

    } // END function _getIndex

    /**
     * _getIndexPath()
     *
     * Gets an index path for a given model name
     *
     * @param string $modelName
     * @return string
     */
    protected function _getIndexPath ($modelName)
    {
        $filter = new Zend_Filter;
        $filter->addFilter(new Zend_Filter_Word_UnderscoreToDash);
        $filter->addFilter(new Zend_Filter_StringToLower);

        return ROOT_PATH . '/tmp/zend_lucene_' . $filter->filter($modelName);
    }

} // END class App_Model_Lucene
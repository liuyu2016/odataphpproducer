<?php
/**  
 * A type to hold the parsed information about the filter option.
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_ExpressionParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\UriProcessor\QueryProcessor\ExpressionParser;
use ODataProducer\UriProcessor\QueryProcessor\AnonymousFunction;
/**
 * To hold the parsed information about the filter option.
 *
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_ExpressionParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class InternalFilterInfo
{
    /**
     * The structure holds information about the navigation properties 
     * used in the filter clause (if any). 
     * 
     * @var FilterInfo
     */
    private $_filterInfo;

    /**
     * The top filter function
     * 
     * @var AnonymousFunction
     */
    private $_filterFunction;

    /**
     * Constructs a new instance of InternalFilterInfo
     * 
     * @param FilterInfo        $filterInfo     holding navigation properties in 
     *                                          the $filter clause.
     * @param AnonymousFunction $filterFunction The anonymous function generated
     *                                          from $filter clause.
     */
    public function __construct(FilterInfo $filterInfo, AnonymousFunction $filterFunction) 
    {
        $this->_filterInfo = $filterInfo;
        $this->_filterFunction = $filterFunction;
    }

    /**
     * Get reference to resource set reference properties used to in the 
     * filter clause to be passed to IDSQP implementation calls.
     * 
     * @return OrderByInfo
     */
    public function getFilterInfo()
    {
        return $this->_filterInfo;
    }

    /**
     * Get reference to the anonymous function to be used for filtering.
     * 
     * @return AnonymousFunction
     */
    public function getFilterFunction()
    {
        return $this->_filterFunction;
    }
}
?>
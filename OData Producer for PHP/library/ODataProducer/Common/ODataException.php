<?php
/** 
 * Exception class for OData
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Common
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\Common;
/**
 * Class for OData Exception
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Common
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class ODataException extends \Exception
{
    /**
     * The error code
     * 
     * @var int
     */
    private $_errorCode;

    /**
     * The HTTP status code
     * 
     * @var int
     */
    private $_statusCode;
   
    /**
     * Create new instance of ODataException
     * 
     * @param string $message    The error message
     * @param string $statusCode The status code
     * @param string $errorCode  The error code
     * 
     * @return nothing
     */
    public function __construct($message, $statusCode, $errorCode= null)
    {
        $this->_errorCode = $errorCode;
        $this->_statusCode = $statusCode;        
        parent::__construct($message, $errorCode);
    }

    /**
     * Get the status code
     * 
     * @return int
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * Creates and throws an instance of ODataException 
     * representing HTTP bad request error
     * 
     * @param string $message The error message
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function createBadRequestError($message)
    {
        throw new ODataException($message, 400);
    } 

    /**
     * Creates and throws an instance of ODataException 
     * representing syntax error in the query
     * 
     * @param string $message The error message
     * 
     * @throws ODataException
     * @return nothing
     */    
    public static function createSyntaxError($message)
    {
        self::createBadRequestError($message);
    }

    /**
     * Creates and throws an instance of ODataException when a 
     * resource represented by a segment in the url is not found
     * 
     * @param String $segment The segment in the url for which corrosponding
     * resource not present in the data source
     *  
     * @throws ODataException
     * @return nothing
     */
    public static function createResourceNotFoundError($segment)
    {
        throw new ODataException(Messages::uriProcessorResourceNotFound($segment), 404);
    }

    /**
     * Creates and throws an instance of ODataException when a 
     * resouce not found in the data source
     * 
     * @param string $message The error message
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function resourceNotFoundError($message)
    {
        throw new ODataException($message, 404);
    }

    /**
     * Creates and throws an instance of ODataException when some
     * internal error happens in the library
     * 
     * @param string $message The detailed internal error message
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function createInternalServerError($message)
    {
        throw new ODataException($message, 500);
    }

    /**
     * Creates and throws an instance of ODataException when requestor tries to
     * access a resource which is forbidden
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function createForbiddenError()
    {
        throw new ODataException(Messages::uriProcessorForbidden(), 403);
    }

    /**
     * Creates a new exception to indicate Precondition error.
     * 
     * @param string $message Error message for this exception
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function createPreConditionFailedError($message)
    {
        throw new ODataException($message, 412);
    }

    /**
     * Creates a new exception when requestor ask for a service facility
     * which is not implemented by this library.
     * 
     * @param string $message Error message for this exception
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function createNotImplementedError($message)
    {
        throw new ODataException($message, 501);
    }

    /**
     * Creates and throws an instance of ODataException when requestor to
     * set value which is not allowed
     * 
     * @param string $message Error message for this exception
     * 
     * @throws ODataException
     * @return nothing
     */
    public static function notAcceptableError($message)
    {
        throw new ODataException($message, 406);
    }    
    
}
?>
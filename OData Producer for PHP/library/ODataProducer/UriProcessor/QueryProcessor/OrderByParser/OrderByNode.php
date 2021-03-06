<?php
/**
 * Type to represent non-leaf node of 'OrderBy Tree' (the root node and 
 * intermediate nodes[complex/navigation]).
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_OrderByParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\UriProcessor\QueryProcessor\OrderByParser;
use ODataProducer\Providers\Metadata\ResourceSetWrapper;
/**
 * Type to represent non-leaf node of 'OrderBy Tree'.
 * 
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_OrderByParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class OrderByNode extends OrderByBaseNode
{
    /**
     * The resource set wrapper associated with this node, this will 
     * be null if this node represents a complex sub path segment
     * 
     * @var ResourceSetWrapper
     */
    private $_resourceSetWrapper;

    /**
     * list of child nodes.
     * 
     * @var array(OrderByNode/OrderByLeafNode)
     */
    private $_childNodes = array();

    /**
     * Construct a new instance of OrderByNode
     * 
     * @param string             $propertyName       Name of the property corrosponds
     *                                               to the sub path
     *                                               segment represented by 
     *                                               this node, this parameter
     *                                               will be null if this
     *                                               node is root.
     * @param ResourceProperty   $resourceProperty   Resource property corrosponds 
     *                                               to the sub path 
     *                                               segment represented by this
     *                                               node, this parameter
     *                                               will be null if 
     *                                               this node is root.
     * @param ResourceSetWrapper $resourceSetWrapper The resource set wrapper
     *                                               associated with the sub path 
     *                                               segment represented by this 
     *                                               node, this will be null 
     *                                               if this node represents a 
     *                                               complex sub path segment
     */
    public function __construct($propertyName, $resourceProperty, $resourceSetWrapper)
    {
        // This must be the parameter state at this point, we won't chek 
        // these as this is an internal class
        //if ($resourceProperty != NULL)
        //{
        //    Node represents navigation or complex
        //    if ($resourceProperty::Kind == Complex)
        //        assert($resourceSetWrapper == null);
        //    else if ($resourceProperty::Kind == ResourceReference) 
        //        assert($resourceSetWrapper !== null);
        //} else {
        //    Node represents root
        //    assert($resourceSetWrapper != null)
        //}
        parent::__construct($propertyName, $resourceProperty);
        $this->_resourceSetWrapper = $resourceSetWrapper;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see library/ODataProducer/QueryProcessor/OrderByParser/ODataProducer\QueryProcessor\OrderByParser.OrderByBaseNode::free()
     * 
     * @return void
     */
    public function free()
    {
        foreach ($this->_childNodes as $childNode) {
            $childNode->free();
        }       
    }

    /**
     * (non-PHPdoc)
     * 
     * @see library/ODataProducer/QueryProcessor/OrderByParser/ODataProducer\QueryProcessor\OrderByParser.OrderByBaseNode::getResourceType()
     * 
     * @return ResourceType
     */
    public function getResourceType()
    {
        return $this->resourceProperty->getResourceType();
    }

    /**
     * To get reference to the resource set wrapper, this will be null 
     * if this node represents a complex sub path segment
     * 
     * @return ResourceSetWrapper
     */
    public function getResourceSetWrapper()
    {
        return $this->_resourceSetWrapper;
    }

    /**
     * Find a child node with given name, if no such child node then return NULL. 
     * 
     * @param string $propertyName Name of the property to get the 
     *                             corrosponding node
     * 
     * @return OrderByNode/OrderByLeafNode/NULL
     */
    public function findNode($propertyName)
    {
        if (array_key_exists($propertyName, $this->_childNodes)) {
            return $this->_childNodes[$propertyName];
        }

        return null;
    }

    /**
     * To add a child node to the list of child nodes.
     * 
     * @param OrderByNode/OrderByLeafNode $node The child node.
     * 
     * @return void
     * 
     * @throws InvalidArgumentException
     */
    public function addNode($node)
    {
        // if (!($node instanceof OrderByNode) 
        //     && !($node instanceof OrderByLeafNode)
        // ) {
            //Error
        // }

        $this->_childNodes[$node->getPropertyName()] = $node;
    }
}
?>
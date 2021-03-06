<?php
/**
 * A type to represent entity set (resource set or container)
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Providers_Metadata
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\Providers\Metadata;
use ODataProducer\Common\Messages;
/**
 * Represents entity set.
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Providers_Metadata
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class ResourceSet
{
    /**
     * name of the entity set (resource set, container)
     * 
     * @var string
     */
    private $_name;

    /**
     * The type hold by this container
     * 
     * @var ResourceType
     */
    private $_resourceType;

    /**
     * Creates new intstance of ResourceSet
     * 
     * @param string       $name         Name of the resource set (entity set)  
     * @param ResourceType $resourceType ResourceType describing the resource 
     *                                   this entity set holds
     * 
     * @throws InvalidArgumentException
     */
    public function __construct($name, ResourceType $resourceType)
    {
        if ($resourceType->getResourceTypeKind() != ResourceTypeKind::ENTITY) {
            throw new \InvalidArgumentException(
                Messages::resourceSetContainerMustBeAssociatedWithEntityType()
            );
        }

        $this->_name = $name;
        $this->_resourceType = $resourceType;
    }

    /**
     * Get the container name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get the type hold by this container
     * 
     * @return ResourceType
     */
    public function getResourceType()
    {
        return $this->_resourceType;
    }
}
?>